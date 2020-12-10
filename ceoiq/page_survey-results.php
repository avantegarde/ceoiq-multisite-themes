<?php
/**
 * Template Name: Survey Results
 * Template Post Type: ceoiq_surveys
 * The template for the survey results
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header('oss'); ?>
<?php // Survey variables
global $wp;
$parentID = wp_get_post_parent_id( $post->ID );
$formID = get_field('survey_form_id', $post->post_parent);
$survey_form = GFAPI::get_form($formID);
$form_questions = $survey_form['fields'];
$company_name = get_the_title($parentID);
$tier_survey_link = home_url( $wp->request ) . '/survey';
$oss_tier = get_query_var('osstier');
$oss_cat = get_query_var('osscat');
$oss_cat_title = get_oss_cat_title($oss_cat);
$T1_search_criteria = array(
    'status'        => 'active',
    'field_filters' => array(
        'mode' => 'all',
        array(
            'key'   => '0',
            'value' => 'T1'
        ),
        /*array(
            'key'   => '3',
            'value' => 'Second Choice'
        )*/
    )
);
$T2_search_criteria = array(
    'status'        => 'active',
    'field_filters' => array(
        'mode' => 'all',
        array(
            'key'   => '0',
            'value' => 'T2'
        ),
        /*array(
            'key'   => '3',
            'value' => 'Second Choice'
        )*/
    )
);
$T3_search_criteria = array(
    'status'        => 'active',
    'field_filters' => array(
        'mode' => 'all',
        array(
            'key'   => '0',
            'value' => 'T3'
        ),
        /*array(
            'key'   => '3',
            'value' => 'Second Choice'
        )*/
    )
);
$T1_entries = GFAPI::get_entries( $formID, $T1_search_criteria );
$T2_entries = GFAPI::get_entries( $formID, $T2_search_criteria );
$T3_entries = GFAPI::get_entries( $formID, $T3_search_criteria );
/*
$T1_total_entries = GFAPI::count_entries( $formID, $T1_search_criteria );
$T2_total_entries = GFAPI::count_entries( $formID, $T2_search_criteria );
$T3_total_entries = GFAPI::count_entries( $formID, $T3_search_criteria );
*/
$T1_total_entries = count($T1_entries);
$T2_total_entries = count($T2_entries);
$T3_total_entries = count($T3_entries);
$yAxes_label = '';
if($oss_tier === '1') {
    $scale_max = 5;
    $chart_stepSize = 1;
} elseif($oss_tier === '2') {
    $scale_max = 5;
    $chart_stepSize = 1;
} elseif($oss_tier === '3') {
    $scale_max = 5;
    $chart_stepSize = 1;
} else {
    //$scale_max = (max($T1_total_entries, $T2_total_entries, $T3_total_entries)) * 5;
    //$chart_stepSize = 5;
    //Percentage
    $scale_max = 100;
    $chart_stepSize = 10;
    $yAxes_label = '%';
}
?>
<?php if($oss_tier != '') : ?>
    <!-- <style>
        #questions .chart-wrap {width: 100%;}
    </style> -->
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
    var chart_options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    min: 0,
                    max: <?php echo $scale_max; ?>,
                    stepSize: <?php echo $chart_stepSize; ?>,
                    callback: function(value, index, values) {
                        return value + '<?php echo $yAxes_label; ?>';
                    }
                }
            }]
        },
        legend: {
            display: false
        },
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    /*var label = data.datasets[tooltipItem.datasetIndex].label || '';

                    if (label) {
                        label += ': ';
                    }
                    label += Math.round(tooltipItem.yLabel * 100) / 100;*/
                    return tooltipItem.yLabel;
                }
            }
        }
    };
</script>

<?php
/*$e1_total = 0;
$e2_total = 0;
$e3_total = 0;
foreach($T1_entries as $entry1) {
    $e1_total = $e1_total + $entry1[3];
}
foreach($T2_entries as $entry2) {
    $e2_total = $e2_total + $entry2[3];
}
foreach($T3_entries as $entry3) {
    $e3_total = $e3_total + $entry3[3];
}
$e1_totals = '['.$e1_total.','.$e2_total.','.$e3_total.']';
//var_dump($T1_entries);

$T1_results = GFAPI::count_entries( $form_id, $T1_search_criteria );
$T2_results = GFAPI::count_entries( $form_id, $T2_search_criteria );
$T3_results = GFAPI::count_entries( $form_id, $T3_search_criteria );
//var_dump($T1_results);
$tiers_array = '['.$T1_results.','.$T2_results.','.$T3_results.']';
//var_dump($tiers_array);*/
?>

<?php
$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$image = $feat_image[0] ? '<img class="featured-icon" src="' . $feat_image[0] . '" width="105">' : '<img class="featured-icon" src="/wp-content/uploads/2017/10/icon-workshops.png" width="105">';
?>
<section id="page-header" class="content-center normal survey-results-header">
    <div class="container">
        <div class="header-content">
            <?php echo $image; ?>
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            <?php if ( $post->post_parent ) : ?>
                <a href="<?php echo get_permalink( $post->post_parent ); ?>" data-button="purple">Dashboard</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php while (have_posts()) : the_post(); ?>
    <section id="primary" class="content-area survey-content">
        <main id="main" class="site-main container" role="main">
            <div class="row">
                <div class="col-md-12">
                <h2 class="results-cat-title"><?php echo $oss_cat_title; ?> | Tier: <?php echo $oss_tier?$oss_tier:'all'; ?></h2>
                <?php //START: pw protection
                if ( post_password_required() ) : ?>
                    <div class="wppw-form">
                        <?php the_content(); ?>
                    </div>
                <?php else : ?>
                    <ul id="questions">
                        <?php foreach($form_questions as $question) :
                            $cat_items = get_oss_cat($oss_cat);
                            $cat_notes = get_oss_cat($oss_cat, true);// true value grabs category "comments" field.
                            $label = htmlspecialchars($question['label']);
                            $choices = $question['choices'];
                            $questionID = $question['id'];
                            $T1question_totals = get_question_totals($T1_entries,$questionID);
                            $T2question_totals = get_question_totals($T2_entries,$questionID);
                            $T3question_totals = get_question_totals($T3_entries,$questionID);
                            $T1question_notes = get_cat_notes($T1_entries,$questionID);
                            $T2question_notes = get_cat_notes($T2_entries,$questionID);
                            $T3question_notes = get_cat_notes($T3_entries,$questionID);
                            if($oss_tier === '1') {
                                $q_entries = get_tier_entries($T1_entries,$questionID);
                                $qtotals = '['. implode(",",$q_entries) . ']';
                                $chart_labels = build_tier_labels($T1_entries,$questionID);
                                $tier_notes = $T1question_notes;
                            } elseif($oss_tier === '2') {
                                $q_entries = get_tier_entries($T2_entries,$questionID);
                                $qtotals = '['. implode(",",$q_entries) . ']';
                                $chart_labels = build_tier_labels($T2_entries,$questionID);
                                $tier_notes = $T2question_notes;
                            } elseif($oss_tier === '3') {
                                $q_entries = get_tier_entries($T3_entries,$questionID);
                                $qtotals = '['. implode(",",$q_entries) . ']';
                                $chart_labels = build_tier_labels($T3_entries,$questionID);
                                $tier_notes = $T3question_notes;
                            } else {
                                $T1_percent = get_question_percent($T1question_totals,$T1_total_entries);
                                $T2_percent = get_question_percent($T2question_totals,$T2_total_entries);
                                $T3_percent = get_question_percent($T3question_totals,$T3_total_entries);
                                $qtotals = '['.$T1_percent.','.$T2_percent.','.$T3_percent.']';
                                //$qtotals = '['.$T1question_totals.','.$T2question_totals.','.$T3question_totals.']';
                                $chart_labels = "['Tier 1', 'Tier 2', 'Tier 3']";
                                //$q_notes = array_merge($T1question_notes,$T2question_notes,$T3question_notes);
                            }
                        ?>
                            <?php if (in_array($questionID, $cat_items)) :?>
                                <li>
                                    <h3 class="question-title"><?php echo $label; ?></h3>
                                    <!-- <ul>
                                        <?php foreach($choices as $choice) : ?>
                                            <li><?php echo $choice['text']; ?></li>
                                        <?php endforeach; ?>
                                    </ul> -->
                                    <div class="chart-wrap">
                                        <canvas id="ossChart<?php echo $questionID; ?>"></canvas>
                                    </div>
                                    <script>
                                        var ctx = document.getElementById('ossChart<?php echo $questionID; ?>').getContext('2d');
                                        var colors = ['#00345f','#069e24','#613d89','#00345f','#069e24','#613d89','#00345f','#069e24','#613d89','#00345f','#069e24','#613d89','#00345f','#069e24','#613d89','#00345f','#069e24','#613d89','#00345f','#069e24','#613d89','#00345f','#069e24','#613d89','#00345f','#069e24','#613d89','#00345f','#069e24','#613d89',];
                                        var chart = new Chart(ctx, {
                                            // The type of chart we want to create
                                            type: 'bar',
                                            // The data for our dataset
                                            data: {
                                                labels: <?php echo $chart_labels; ?>,
                                                datasets: [{
                                                    label: <?php echo '"'.$label.'"'; ?>,
                                                    backgroundColor: colors,
                                                    borderColor: 'rgb(255, 99, 132)',
                                                    data: <?php echo $qtotals; ?>,
                                                }]
                                            },
                                            // Configuration options go here
                                            options: chart_options,
                                        });
                                    </script>
                                </li>
                            <?php endif; ?>
                            <?php if (in_array($questionID, $cat_notes)) :?>
                                <li>
                                    <?php // echo $label; ?>
                                    <h3 class="question-title">Comments &amp; Feedback</h3>
                                    <?php if ($tier_notes) : ?>
                                        <ul class="section-notes">
                                            <?php foreach($tier_notes as $note) : ?>
                                                <?php if (!empty($note)) : ?>
                                                    <li class="q-note"><?php echo $note; ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else : ?>
                                        <h4>Tier 1</h4>
                                        <ul class="section-notes">
                                            <?php foreach($T1question_notes as $t1note) : ?>
                                                <?php if (!empty($t1note)) : ?>
                                                    <li class="q-note t1"><?php echo $t1note; ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                        <hr>
                                        <h4>Tier 2</h4>
                                        <ul class="section-notes">
                                            <?php foreach($T2question_notes as $t2note) : ?>
                                                <?php if (!empty($t2note)) : ?>
                                                    <li class="q-note t2"><?php echo $t2note; ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                        <hr>
                                        <h4>Tier 3</h4>
                                        <ul class="section-notes">
                                            <?php foreach($T3question_notes as $t3note) : ?>
                                                <?php if (!empty($t3note)) : ?>
                                                    <li class="q-note t3"><?php echo $t3note; ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>

                    <div id="survey-pagination">
                        <?php
                        // START: Pagination
                        if ($oss_tier != '' && $oss_cat > 1 && $oss_cat < 12) :
                            echo '<a class="prev" href="' . home_url( $wp->request ) . '/?osstier='.$oss_tier.'&osscat=' . ($oss_cat-1) . '" data-button="purple">Prev Category</a>';
                        elseif ($oss_cat > 1 && $oss_cat < 12) :
                            echo '<a class="prev" href="' . home_url( $wp->request ) . '/?osscat=' . ($oss_cat-1) . '" data-button="purple">Prev Category</a>';
                        endif;

                        if ($oss_tier != '' && $oss_cat > 0 && $oss_cat < 11) :
                            echo '<a class="next" href="' . home_url( $wp->request ) . '/?osstier='.$oss_tier.'&osscat=' . ($oss_cat+1) . '" data-button>Next Category</a>';
                        elseif ($oss_cat > 0 && $oss_cat < 11) :
                            echo '<a class="next" href="' . home_url( $wp->request ) . '/?osscat=' . ($oss_cat+1) . '" data-button>Next Category</a>';
                        endif;
                        // END: Pagination
                        ?>
                    </div>

                    <?php // get_template_part('template-parts/content', 'page'); ?>

                <?php endif; //END: pw protection ?>
                </div>
            </div>
        </main><!-- #main -->
    </section><!-- #primary -->
<?php endwhile; // End of the loop. ?>

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

<?php wp_footer(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() . '/js/EQCSS-polyfills.min.js'?>"></script><![endif]-->
</body>
</html>

