<?php
/**
 * Template Name: Company Dashboard
 * Template Post Type: ceoiq_surveys
 * The default full-width template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */
get_header('oss'); ?>
<?php // Survey variables
global $wp;
$this_post = get_post($post->ID);
$formID = get_field('survey_form_id');
$company_name = get_the_title($post->ID);
$tier_survey_link = home_url( $wp->request ) . '/survey';
$tier1_survey_link = home_url( $wp->request ) . '/survey?osstier=T1';
$tier2_survey_link = home_url( $wp->request ) . '/survey?osstier=T2';
$tier3_survey_link = home_url( $wp->request ) . '/survey?osstier=T3';
$tier_result_link = home_url( $wp->request ) . '/results';
$survey_page_id = url_to_postid($tier_survey_link);
$survey_page = get_post($survey_page_id);
//$survey_pw = $this_post->post_password?$this_post->post_password:NULL;
$survey_pw = $survey_page->post_password;
$oss_invite = get_query_var('ossinvite');
$oss_static_questions = get_query_var('ossquestions');
$T1_entry_search = array(
    'status'        => 'active',
    'field_filters' => array(
        'mode' => 'all',
        array(
            'key'   => '0',
            'value' => 'T1'
        ),
    )
);
$T2_entry_search = array(
    'status'        => 'active',
    'field_filters' => array(
        'mode' => 'all',
        array(
            'key'   => '0',
            'value' => 'T2'
        ),
    )
);
$T3_entry_search = array(
    'status'        => 'active',
    'field_filters' => array(
        'mode' => 'all',
        array(
            'key'   => '0',
            'value' => 'T3'
        ),
    )
);
$T1_entries = GFAPI::get_entries( $formID, $T1_entry_search );
$T2_entries = GFAPI::get_entries( $formID, $T2_entry_search );
$T3_entries = GFAPI::get_entries( $formID, $T3_entry_search );
/*
$T1_total_entries = GFAPI::count_entries( $formID, $T1_search_criteria );
$T2_total_entries = GFAPI::count_entries( $formID, $T2_search_criteria );
$T3_total_entries = GFAPI::count_entries( $formID, $T3_search_criteria );
*/
$T1_total_entries = count($T1_entries);
$T2_total_entries = count($T2_entries);
$T3_total_entries = count($T3_entries);
global $post;
if (is_page_template('page_survey-dashboard.php')) {
    $company_slug = $post -> post_name;
} else if (is_page_template('page_survey-results.php')) {
    $post_data = get_post($post->post_parent);
    $company_slug = $post_data->post_name;
}
$dashboard_url = home_url('/oss/') . $company_slug;
$invites_url = home_url('/oss/') . $company_slug . '/?ossinvite=1';
$survey_url = home_url('/oss/') . $company_slug . '/survey';
?>
<?php
$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$image = $feat_image[0] ? '<img class="featured-icon" src="' . $feat_image[0] . '" width="105">' : '<img class="featured-icon" src="/wp-content/uploads/2017/10/icon-workshops.png" width="105">';
?>
<section id="page-header" class="content-center normal">
    <div class="container">
        <div class="header-content">
            <?php echo $image; ?>
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </div>
    </div>
</section>

<?php while (have_posts()) : the_post(); ?>
<?php //START: pw protection
if ( post_password_required() ) : ?>
    <style>
        #menu-toggle {display:none !important;}
        #menu-float {display:none !important;}
    </style>
    <section id="primary" class="content-area survey-content">
        <main id="main" class="site-main" role="main">
            <div class="container">
                <div class="wppw-form">
                    <?php the_content(); ?>
                </div>
            </div>
        </main><!-- #main -->
    </section><!-- #primary -->
</div><!-- #content -->

    <footer id="colophon" class="site-footer center" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="copyright">
                        <?php echo 'Copyright &copy; ' . date('Y') . ' - ' . get_bloginfo( 'name' ); ?> <span class="hidden-xs">| </span><span class="hidden-sm"><br></span><a href="/terms-of-use/">Terms of Use</a> | <a href="/privacy-policy/">Privacy Policy</a>
                    </p>
                </div>
            </div>
        </div><!-- .inner -->
    </footer><!-- #colophon -->

</div><!-- #page -->
<?php else : ?>
    <section id="primary" class="content-area survey-content">
        <main id="main" class="site-main" role="main">

            <div class="dashboard-intro">
                <p>Welcome to your CEOIQ<sup>&reg;</sup> Organizational Snapshot Survey&trade; dashboard, where you can monitor survey progress and access real-time results. Use the menu in the top right corner to navigate to other sections where you'll be able to send survey invitations, preview survey questions, view historical benchmarks, and access the tutorial at any time.</p>
            </div>

            <!-- <div class="container invites-toggle">
                <?php// if($oss_invite === '1') : ?>
                    <a href="<?php// echo home_url( $wp->request ); ?>" data-button>Hide Invites</a>
                <?php// else : ?>
                    <a href="<?php// echo home_url( $wp->request ) . '/?ossinvite=1'; ?>" data-button>Send Invites</a>
                <?php// endif; ?>
            </div> -->

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php if($oss_invite === '1') : ?>
                        <!-- START: email invites -->
                        <section id="survey-invites" class="survey-invites blank">
                            <div class="container">
                                <h2 class="center">Tier E-mailing</h2>
                                <p class="center">Enter email addresses or copy & paste from them from a list into their respective Tier fields. Separate each email with a comma.</p>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo do_shortcode('[gravityform id="10" title="false" description="false" ajax="false" tabindex="99" field_values="survey_company_name='.$company_name.'&survey_group_link='.$tier_survey_link.'&survey_password='.$survey_pw.'"]'); ?>
                                    </div>
                                    <div class="col-md-12 invite-reminders">
                                        <h3 class="center">Send Reminder Emails</h3>
                                        <?php
                                        $notification_formID = '10';
                                        $company_val = sanitize_text_field($company_name);
                                        // grab specific company entries
                                        $company_search_criteria = array(
                                            'status'        => 'active',
                                            'field_filters' => array(
                                                'mode' => 'all',
                                                array(
                                                    'key'   => '14',
                                                    'value' => $company_val,
                                                ),
                                            )
                                        );
                                        $company_entries = GFAPI::get_entries( $notification_formID, $company_search_criteria);
                                        // Grab grouped email lists
                                        $T1_emails = array();
                                        foreach ($company_entries as $t1entry) {
                                            array_push($T1_emails, $t1entry[10]);
                                        }
                                        $T2_emails = array();
                                        foreach ($company_entries as $t2entry) {
                                            array_push($T2_emails, $t2entry[11]);
                                        }
                                        $T3_emails = array();
                                        foreach ($company_entries as $t3entry) {
                                            array_push($T3_emails, $t3entry[12]);
                                        }
                                        //$T1_emails = $company_entries[0][10];
                                        //$T2_emails = $company_entries[0][11];
                                        //$T3_emails = $company_entries[0][12];
                                        $T1_emails_str = implode (",", $T1_emails);
                                        $T2_emails_str = implode (",", $T2_emails);
                                        $T3_emails_str = implode (",", $T3_emails);
                                        ?>
                                        <div id="notification-alerts"></div>
                                        <a class="g1-notifications" data-button>Tier 1</a>
                                        <a class="g2-notifications" data-button>Tier 2</a>
                                        <a class="g3-notifications" data-button>Tier 3</a>
                                        <script>
                                            jQuery('.g1-notifications').click(function() {
                                                jQuery.ajax({
                                                    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                                                    type:'POST',
                                                    data: 'action=ceoiq_notifications&emails=<?php echo urlencode($T1_emails_str); ?>&tierlink=<?php echo urlencode($tier1_survey_link); ?>&sp=<?php echo $survey_pw; ?>',
                                                    success: function(html) {
                                                        jQuery('#notification-alerts').append('Your reminder has been sent.');
                                                        jQuery('#notification-alerts').slideDown();
                                                        setTimeout(function() { 
                                                            jQuery('#notification-alerts').slideUp();
                                                            jQuery('#notification-alerts').html('');
                                                        }, 2000);
                                                    }
                                                });

                                            });
                                            jQuery('.g2-notifications').click(function() {
                                                jQuery.ajax({
                                                    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                                                    type:'POST',
                                                    data: 'action=ceoiq_notifications&emails=<?php echo urlencode($T2_emails_str); ?>&tierlink=<?php echo urlencode($tier2_survey_link); ?>&sp=<?php echo $survey_pw; ?>',
                                                    success: function(html) {
                                                        jQuery('#notification-alerts').append('Your reminder has been sent.');
                                                        jQuery('#notification-alerts').slideDown();
                                                        setTimeout(function() { 
                                                            jQuery('#notification-alerts').slideUp();
                                                            jQuery('#notification-alerts').html('');
                                                        }, 2000);
                                                    }
                                                });

                                            });
                                            jQuery('.g3-notifications').click(function() {
                                                jQuery.ajax({
                                                    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                                                    type:'POST',
                                                    data: 'action=ceoiq_notifications&emails=<?php echo urlencode($T3_emails_str); ?>&tierlink=<?php echo urlencode($tier3_survey_link); ?>&sp=<?php echo $survey_pw; ?>',
                                                    success: function(html) {
                                                        jQuery('#notification-alerts').append('Your reminder has been sent.');
                                                        jQuery('#notification-alerts').slideDown();
                                                        setTimeout(function() { 
                                                            jQuery('#notification-alerts').slideUp();
                                                            jQuery('#notification-alerts').html('');
                                                        }, 2000);
                                                    }
                                                });

                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <hr>
                        <!-- END: email invites -->
                    <?php elseif($oss_static_questions === '1') : ?>
                        <!-- START: survey questions -->
                        <?php get_template_part('template-parts/content', 'survey_questions'); ?>
                        <!-- END: survey questions -->
                    <?php else : ?>
                        <!-- START: dashboard overview -->
                        <section id="survey-overview" class="survey-overview blank">
                            <div class="container">
                                <table id="results-overview">
                                    <caption><h2 class="section-title center">Survey Results<sup><i id="info-results" class="fa fa-question-circle"></i></sup></h2></caption>
                                    <thead>
                                        <tr>
                                            <th>TOTAL ENTRIES</th>
                                            <th class="tier1">Tier 1 <span class="g1-total-entries"><?php echo $T1_total_entries; ?></span></th>
                                            <th class="tier2">Tier 2 <span class="g2-total-entries"><?php echo $T2_total_entries; ?></span></th>
                                            <th class="tier3">Tier 3 <span class="g3-total-entries"><?php echo $T3_total_entries; ?></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="spacer">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th class="cell-link"><a href="<?php echo $tier_result_link . '/?osstier=1&osscat=1'; ?>">Tier 1</a></th>
                                            <th class="cell-link"><a href="<?php echo $tier_result_link . '/?osstier=2&osscat=1'; ?>">Tier 2</a></th>
                                            <th class="cell-link"><a href="<?php echo $tier_result_link . '/?osstier=3&osscat=1'; ?>">Tier 3</a></th>
                                        </tr>
                                        <?php for($cat_n = 1; $cat_n <= 8; $cat_n++) : ?>
                                            <?php
                                                $t1_cat_totals = get_cat_totals($T1_entries, $cat_n);
                                                $t2_cat_totals = get_cat_totals($T2_entries, $cat_n);
                                                $t3_cat_totals = get_cat_totals($T3_entries, $cat_n);
                                                $oss_cat = get_oss_cat($cat_n);
                                                $oss_cat_title = get_oss_cat_title($cat_n);
                                                $cat_progress_max = count($oss_cat);
                                                $T1_progress_max = $T1_total_entries * $cat_progress_max * 5;
                                                $T2_progress_max = $T2_total_entries * $cat_progress_max * 5;
                                                $T3_progress_max = $T3_total_entries * $cat_progress_max * 5;
                                            ?>
                                            <tr>
                                                <th class="cell-link"><a href="<?php echo $tier_result_link . '?osscat=' . $cat_n; ?>"><?php echo $oss_cat_title; ?></a></th>
                                                <td>
                                                    <progress min=0 value=<?php echo $t1_cat_totals; ?> max=<?php echo $T1_progress_max; ?>></progress>
                                                    <span class="values" value=<?php echo $t1_cat_totals; ?> max=<?php echo $T1_progress_max; ?>></span>
                                                </td>
                                                <td>
                                                    <progress min=0 value=<?php echo $t2_cat_totals; ?> max=<?php echo $T2_progress_max; ?>></progress>
                                                    <span class="values" value=<?php echo $t2_cat_totals; ?> max=<?php echo $T2_progress_max; ?>></span>
                                                </td>
                                                <td>
                                                    <progress min=0 value=<?php echo $t3_cat_totals; ?> max=<?php echo $T3_progress_max; ?>></progress>
                                                    <span class="values" value=<?php echo $t3_cat_totals; ?> max=<?php echo $T3_progress_max; ?>></span>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <hr>
                        <section id="export" class="center">
                            <?php
                                $T1_export_entries = oss_format_entries_export($T1_entries);
                                $T2_export_entries = oss_format_entries_export($T2_entries);
                                $T3_export_entries = oss_format_entries_export($T3_entries);
                            ?>
                            <h2 class="section-title center">Export Results <small>(csv)</small></h2>
                            <a class="export-csv" data-button onclick='downloadCSV({ filename: "T1entries.csv", tier: "T1" });'>Tier 1</a>
                            <a class="export-csv" data-button onclick='downloadCSV({ filename: "T2entries.csv", tier: "T2" });'>Tier 2</a>
                            <a class="export-csv" data-button onclick='downloadCSV({ filename: "T3entries.csv", tier: "T3" });'>Tier 3</a>
                            <br>
                            <a class="export-csv" data-button onclick='downloadCSV({ filename: "ALLentries.csv", tier: "ALL" });'>ALL Tiers</a>
                            <script>
                                var T1_csv_entries = <?php echo json_encode($T1_export_entries); ?>;
                                var T2_csv_entries = <?php echo json_encode($T2_export_entries); ?>;
                                var T3_csv_entries = <?php echo json_encode($T3_export_entries); ?>;
                                var ALL_csv_entries = T1_csv_entries.concat(T2_csv_entries, T3_csv_entries);
                                function convertArrayOfObjectsToCSV(args) {
                                    var result, ctr, keys, columnDelimiter, lineDelimiter, data;

                                    data = args.data || null;
                                    if (data == null || !data.length) {
                                        return null;
                                    }

                                    columnDelimiter = args.columnDelimiter || ',';
                                    lineDelimiter = args.lineDelimiter || '\n';

                                    keys = Object.keys(data[0]);

                                    result = '';
                                    result += keys.map(x => `"${x}"`).join(columnDelimiter);
                                    result += lineDelimiter;

                                    data.forEach(function(item) {
                                        ctr = 0;
                                        keys.forEach(function(key) {
                                            if (ctr > 0) result += columnDelimiter;
                                            result += '"' + item[key] + '"';
                                            ctr++;
                                        });
                                        result += lineDelimiter;
                                    });

                                    return result;
                                }
                                function downloadCSV(args) {
                                    var data, filename, link;
                                    if(args.tier == 'T1') {
                                        var csv_entries = T1_csv_entries;
                                    } else if (args.tier == 'T2') {
                                        var csv_entries = T2_csv_entries;
                                    } else if (args.tier == 'T3') {
                                        var csv_entries = T3_csv_entries;
                                    } else if (args.tier == 'ALL') {
                                        var csv_entries = ALL_csv_entries;
                                    }

                                    var csv = convertArrayOfObjectsToCSV({
                                        data: csv_entries
                                    });
                                    if (csv == null) return;

                                    filename = args.filename || 'export.csv';

                                    var blob = new Blob([csv], {type: "text/csv;charset=utf-8;"});

                                    if (navigator.msSaveBlob) { // IE 10+
                                        navigator.msSaveBlob(blob, filename)
                                    } else {
                                        var link = document.createElement("a");
                                        if (link.download !== undefined) {
                                            // feature detection, Browsers that support HTML5 download attribute
                                            var url = URL.createObjectURL(blob);
                                            link.setAttribute("href", url);
                                            link.setAttribute("download", filename);
                                            link.style = "visibility:hidden";
                                            document.body.appendChild(link);
                                            link.click();
                                            document.body.removeChild(link);
                                        }
                                    }
                                }
                            </script>
                        </section>
                        <!-- END: dashboard overview -->
                    <?php endif; ?>
                </div><!-- .entry-content -->
            </article><!-- #post-## -->
        </main><!-- #main -->
    </section><!-- #primary -->
</div><!-- #content -->

<footer id="colophon" class="site-footer center" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p class="copyright">
                    <?php echo 'Copyright &copy; ' . date('Y') . ' - ' . get_bloginfo( 'name' ); ?> <span class="hidden-xs">| </span><span class="hidden-sm"><br></span><a href="/terms-of-use/">Terms of Use</a> | <a href="/privacy-policy/">Privacy Policy</a>
                </p>
            </div>
        </div>
    </div><!-- .inner -->
</footer><!-- #colophon -->

</div><!-- #page -->

<!--  START: Tutorial -->
<div id="oss-tutorial" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="oss-intro">
                    <div>
                        <h1>Welcome</h1>
                        <p class="tut-overview">Welcome to your CEOIQ<sup>&reg;</sup> Organizational Snapshot Survey&trade; dashboard! By using this tool, you will be able to identify organizational weaknesses and gather useful information to help improve these areas.</p>
                        <img src="/wp-content/themes/ceoiq/inc/images/oss/tut-intro.jpg" alt="Overview">
                        <hr>
                        <button class="slide-next" data-button>Next ></button>
                    </div>
                    <div>
                        <h1>Overview</h1>
                        <p>The CEOIQ<sup>&reg;</sup> Organizational Snapshot Survey&trade; is an online survey that includes 83 multiple choice questions across 8 categories, as well as additional comment sections. It is designed to compare results among three tier groups—Tier 1, Tier 2 and Tier 3. Each question has five possible answers, which translates to a 5-point scoring system. Depending on what answer is selected, a point value between 1-5 is awarded. See point breakdown below:</p>
                        <img src="/wp-content/themes/ceoiq/inc/images/oss/tut-question-ranks.jpg" alt="Overview">
                        <hr>
                        <button class="slide-next" data-button>Next ></button>
                    </div>
                    <div>
                        <h1>Dashboard</h1>
                        <p>Your dashboard allows you to monitor survey progress and access real-time results. Use the menu in the top right corner to navigate to other sections where you'll be able to send survey invitations, preview survey questions, view historical benchmarks, and access this tutorial at any time.</p>
                        <img src="/wp-content/themes/ceoiq/inc/images/oss/tut-dashboard.jpg" alt="Dashboard">
                        <hr>
                        <button class="slide-next" data-button>Next ></button>
                    </div>
                    <div>
                        <h1>Survey Results</h1>
                        <p>Quickly see how many respondents have completed the survey by assessing the Total Entries. The interactive survey results grid provides an overview of aggregate responses among the three Tiers. Each column represents it's respective Tier data while each row corresponds to a specific category. The progress bar in each cell is a visual representation of total points scored versus total points available. The numbers below show the numerical point totals—these numbers change as more respondents complete the survey.</p>
                        <img src="/wp-content/themes/ceoiq/inc/images/oss/tut-slide-4.jpg" alt="Survey Results">
                        <hr>
                        <button class="slide-next" data-button>Next ></button>
                    </div>
                    <div>
                        <h1>Tier Results</h1>
                        <p>Click on a specific tier from the results grid to view filtered results for that tier only. You will be able to see how respondents in that tier answered each question in a given category.</p>
                        <img class="wide-img" src="/wp-content/themes/ceoiq/inc/images/oss/tut-tiers.jpg" alt="Tier Results">
                        <hr>
                        <button class="slide-next" data-button>Next ></button>
                    </div>
                    <div>
                        <h1>Category Results</h1>
                        <p>You may click on a specific category from the results grid to view filtered results for that category only. You will be able to see how respondents across the three tiers answered each question in that category.</p>
                        <img class="wide-img" src="/wp-content/themes/ceoiq/inc/images/oss/tut-cats.jpg" alt="Category Results">
                        <hr>
                        <button class="slide-next" data-button>Next ></button>
                    </div>
                    <div>
                        <h1>Send Invites</h1>
                        <p>Invite survey participants in the Send Invites section. You may enter individual email addresses or copy & paste from a list in the Tier 1, Tier 2, or Tier 3 field. You can also send a completion reminder to survey participants in any tier at any time using the "Send Reminder" button.</p>
                        <img src="/wp-content/themes/ceoiq/inc/images/oss/tut-invites.jpg" alt="Send Invites">
                        <hr>
                        <button type="button" class="" data-dismiss="modal" aria-label="Close" data-button>View Dashboard</button>
                        <a href="<?php echo $invites_url; ?>" data-button>Send Invites</a>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--  START: info-results -->
<div id="info-results-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="info-results center">
                    <div>
                        <h1>Survey Results</h1>
                        <p>The CEOIQ<sup>&reg;</sup> Organizational Snapshot Survey&trade; is an online survey that includes 83 multiple choice questions across 8 categories, as well as additional comment sections. It is designed to compare results among three tier groups—Tier 1, Tier 2 and Tier 3. Each question has five possible answers, which translates to a 5-point scoring system. Depending on what answer is selected, a point value between 1-5 is awarded. See point breakdown below:</p>
                        <img src="/wp-content/themes/ceoiq/inc/images/oss/tut-question-ranks.jpg" alt="Overview">
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--  END: info-results -->

<script>
    // Set Cookie
    function setCookie(cname, cvalue, exdays, path) {
        var d = new Date();
        if (path){
            var path = path;
        } else {
            var path = "";
        }
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/" + path;
    }
    // Get Cookie
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    jQuery(document).ready(function ($) {
        // Cookie Enabled Modal
        function cookiePop(){
            var modalSession = getCookie("oss_tutorial");
            var url = window.location.href;
            if(url.indexOf('?welcome=1') != -1) {
                // query string activation
                $('#oss-tutorial').modal('show');
            } else {
                if (modalSession != "") {
                    // Cookie Found, Don't Trigger Modal
                    return false;
                } else {
                    // Cookie NOT Found
                    //Trigger Modal
                    $('#oss-tutorial').modal('show');
                }
            }
        }cookiePop();
        // Set cookie after modal closes
        $('#oss-tutorial').on('hidden.bs.modal', function (e) {
            setCookie("oss_tutorial", "value", 999, "");
        });
        // Tutorial Slider
        $('.oss-intro').slick({
            infinite: true,
            dots: true,
            arrows: false,
            autoplay: false,
            speed: 1000,
            adaptiveHeight: true
        });
        $('button.slide-next').click(function(){
            $('.oss-intro').slick('slickNext');
        });
        // Info Modal
        $('#info-results').click(function(e){
            e.preventDefault();
            $('#info-results-modal').modal('show');
        });
    });// END document.ready
</script>
<!--  END: Tutorial -->











    <?php 
    $current_user = wp_get_current_user();
    if (user_can( $current_user, 'administrator' )) :
        $this_post = get_post($post->ID);
        $consult_pw = $this_post->post_password?$this_post->post_password:'No Password Set!';
        $cookie_company_name = str_replace(' ', '_', $company_name);
    ?>

        <!--  START: Admin Invite -->
        <div id="admin-invite" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="oss-admin-invite">
                            <h1 class="center">Consultant Invite</h1>
                            <?php echo do_shortcode('[gravityform id="13" title="false" description="false" ajax="false" tabindex="99" field_values="survey_company_name='.$company_name.'&oss_dash_pass='.$consult_pw.'&oss_dash_link='.home_url( $wp->request ).'"]'); ?>
                            <hr>
                            <p class="center">
                                <?php edit_post_link('Edit Company Survey'); ?>
                            </p>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script>
            // Set Cookie
            function setCookie(cname, cvalue, exdays, path) {
                var d = new Date();
                if (path){
                    var path = path;
                } else {
                    var path = "";
                }
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+d.toUTCString();
                document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/" + path;
            }
            // Get Cookie
            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
            jQuery(document).ready(function ($) {
                // Cookie Enabled Modal
                function cookiePop(){
                    var modalSession = getCookie("oss_ci_<?php echo $cookie_company_name; ?>");
                    var url = window.location.href;
                    if(url.indexOf('?consult-invite=1') != -1) {
                        // query string activation
                        $('#admin-invite').modal('show');
                    } else {
                        if (modalSession != "") {
                            // Cookie Found, Don't Trigger Modal
                            return false;
                        } else {
                            // Cookie NOT Found
                            //Trigger Modal
                            $('#admin-invite').modal('show');
                        }
                    }
                }cookiePop();
                // Set cookie after modal closes
                $('#admin-invite').on('hidden.bs.modal', function (e) {
                    setCookie("oss_ci_<?php echo $cookie_company_name; ?>", "value", 999, "");
                });
            });// END document.ready
        </script>
        <!--  END: Admin Invite -->
    <?php endif; //END: admin invite check ?>
<?php endif; //END: pw protection ?>
<?php endwhile; // End of the loop. ?>

<?php wp_footer(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() . '/js/EQCSS-polyfills.min.js'?>"></script><![endif]-->
</body>
</html>

