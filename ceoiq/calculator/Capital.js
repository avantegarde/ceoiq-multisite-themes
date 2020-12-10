KJE.CapitalCalc=function(){this.TARGET_WORKING_CAPITAL=0;this.MONTHS_OF_ANALYSIS=12;this.WORKING_CAPITAL_CHANGE="";this.WORKING_CAPITAL_DIFF=0;this.MSG_UP=KJE.parameters.get("MSG_UP","You may need to increase your working capital KJE1.");this.MSG_DOWN=KJE.parameters.get("MSG_DOWN","You may be able to decrease your working capital KJE1.");this.MSG_SAME=KJE.parameters.get("MSG_SAME","Your current working capital of KJE1 appears on target.");this.sSchedule=new KJE.Repeating()};KJE.CapitalCalc.prototype.clear=function(){this.TOTAL_CURRENT_ASSETS=0;this.TOTAL_CURRENT_LIABILITIES=0;this.ANNUAL_DESIRED_GROWTH=0;this.TARGET_CURRENT_RATIO=0};KJE.CapitalCalc.prototype.calculate=function(m){var d=KJE;var p=this.TOTAL_CURRENT_ASSETS;var a=this.TOTAL_CURRENT_LIABILITIES;var l=this.ANNUAL_DESIRED_GROWTH;var j=this.TARGET_CURRENT_RATIO;var b=0;var e=p/a;var k=p-a;var h=KJE.ROR_MONTH(l/100);var o=a*j;this.TARGET_WORKING_CAPITAL=this.getWorking(0,h,o,a);this.WORKING_CAPITAL_DIFF=this.TARGET_WORKING_CAPITAL-k;if(this.WORKING_CAPITAL_DIFF>1){this.WORKING_CAPITAL_CHANGE=KJE.getKJEReplaced(this.MSG_UP,d.dollars(this.WORKING_CAPITAL_DIFF))}else{if(this.WORKING_CAPITAL_DIFF<1){this.WORKING_CAPITAL_CHANGE=KJE.getKJEReplaced(this.MSG_DOWN,d.dollars(this.WORKING_CAPITAL_DIFF*-1))}else{this.WORKING_CAPITAL_CHANGE=this.WORKING_CAPITAL_CHANGE=KJE.getKJEReplaced(this.MSG_SAME,d.dollars(k));this.WORKING_CAPITAL_DIFF=0}}var q=Math.round(this.MONTHS_OF_ANALYSIS);var g=0;this.WC_MONTH=KJE.FloatArray(q);this.cats=KJE.FloatArray(q);if(m){var f=this.sSchedule;f.clearRepeat();f.addHeader(f.sReportCol("&nbsp;",1),f.sReportCol("Current Assets*",2),f.sReportCol("Current Liabilities",3),f.sReportCol("Working Capital",4));f.addRepeat(" ",d.dollars(o),d.dollars(a),d.dollars(this.TARGET_WORKING_CAPITAL))}for(var c=1;c<=q;c++){g=c-1;this.cats[g]=""+c;this.WC_MONTH[g]=this.getWorking(c,h,o,a);if(m){f.addRepeat(c,d.dollars(KJE.FV_AMT(h,c,o)),d.dollars(KJE.FV_AMT(h,c,a)),d.dollars(this.WC_MONTH[g]))}}this.ACTUAL_CURRENT_RATIO=e;this.ACTUAL_WORKING_CAPITAL=k;this.MONTHLY_GROWTH_RATE=h;this.TARGET_WORKING_CAPITAL_END=this.WC_MONTH[q-1];this.TARGET_ASSETS=o};KJE.CapitalCalc.prototype.formatReport=function(a){var b=KJE;var c=a;c=KJE.replace("TOTAL_CURRENT_ASSETS",b.dollars(this.TOTAL_CURRENT_ASSETS),c);c=KJE.replace("TOTAL_CURRENT_LIABILITIES",b.dollars(this.TOTAL_CURRENT_LIABILITIES),c);c=KJE.replace("ANNUAL_DESIRED_GROWTH",b.percent(this.ANNUAL_DESIRED_GROWTH/100),c);c=KJE.replace("ACTUAL_CURRENT_RATIO",b.number(this.ACTUAL_CURRENT_RATIO,2),c);c=KJE.replace("TARGET_WORKING_CAPITAL_END",b.dollars(this.TARGET_WORKING_CAPITAL_END),c);c=KJE.replace("ACTUAL_WORKING_CAPITAL",b.dollars(this.ACTUAL_WORKING_CAPITAL),c);c=KJE.replace("TARGET_CURRENT_RATIO",b.number(this.TARGET_CURRENT_RATIO,2),c);c=KJE.replace("MONTHLY_GROWTH_RATE",b.percent(this.MONTHLY_GROWTH_RATE,2),c);c=KJE.replace("TARGET_WORKING_CAPITAL",b.dollars(this.TARGET_WORKING_CAPITAL),c);c=KJE.replace("MONTHS_OF_ANALYSIS",b.number(this.MONTHS_OF_ANALYSIS),c);c=KJE.replace("TARGET_ASSETS",b.dollars(this.TARGET_ASSETS),c);c=KJE.replace("WORKING_CAPITAL_CHANGE",this.WORKING_CAPITAL_CHANGE,c);c=KJE.replace("WORKING_CAPITAL_DIFF",b.dollars(this.WORKING_CAPITAL_DIFF),c);c=c.replace("**REPEATING GROUP**",this.sSchedule.getRepeat());this.sSchedule.clearRepeat();return c};KJE.CapitalCalc.prototype.getWorking=function(d,a,b,c){return KJE.FV_AMT(a,d,b)-KJE.FV_AMT(a,d,c)};KJE.CalcName="Working Capital Needs Calculator";KJE.CalcType="capital";KJE.CalculatorTitleTemplate="KJE1";KJE.initialize=function(){KJE.CalcControl=new KJE.CapitalCalc();KJE.GuiControl=new KJE.Capital(KJE.CalcControl)};KJE.Capital=function(i){var c=KJE;var b=KJE.gLegend;var f=KJE.inputs.items;this.MSG_LABEL3=KJE.parameters.get("MSG_LABEL3","month");this.MSG_LABEL4=KJE.parameters.get("MSG_LABEL4","Working capital month");KJE.DollarSlider("TOTAL_CURRENT_ASSETS","Total current assets",1,10000000);KJE.DollarSlider("TOTAL_CURRENT_LIABILITIES","Total current liabilities",1,10000000);KJE.PercentSlider("ANNUAL_DESIRED_GROWTH","Annual growth",0,100,0);KJE.NumberSlider("TARGET_CURRENT_RATIO","Target current ratio",1,10,2);KJE.Label("ACTUAL_CURRENT_RATIO","Actual current ratio");KJE.Label("ACTUAL_WORKING_CAPITAL","Current working capital");KJE.Label("TARGET_WORKING_CAPITAL","Target working capital");var g=KJE.gNewGraph(KJE.gCOLUMN,"GRAPH1",true,false,KJE.colorList[1],KJE.parameters.get("MSG_GRAPH_TITLE","Required working capital grows to KJE1 in 12 months."));g._legend.setVisible(false);g._legend._iOrientation=(b.TOP_RIGHT);g._titleXAxis.setText(this.MSG_LABEL3);var a=KJE.parameters.get("MSG_DROPPER_TITLE","Working capital inputs:");var d=KJE.parameters.get("MSG_DROPPER_CLOSETITLE","Assets KJE1, Liabilities KJE2, Annual growth KJE3");var e=function(){return a+KJE.subText(KJE.getKJEReplaced(d,f.TOTAL_CURRENT_ASSETS.getFormatted(),f.TOTAL_CURRENT_LIABILITIES.getFormatted(),f.ANNUAL_DESIRED_GROWTH.getFormatted()),"KJECenter")};KJE.addDropper(new KJE.Dropper("INPUTS",true,a,e),KJE.colorList[0]);var j=KJE.parameters.get("MSG_DROPPER2_TITLE","Calculated results:");var k=KJE.parameters.get("MSG_DROPPER2_CLOSETITLE","Actual current ratio KJE1. Current working capital is KJE2 with a target of KJE3.");var h=function(){return j+KJE.subText(KJE.getKJEReplaced(k,c.number(i.ACTUAL_CURRENT_RATIO,2),c.dollars(i.ACTUAL_WORKING_CAPITAL),c.dollars(i.TARGET_WORKING_CAPITAL)),"KJECenter")};KJE.addDropper(new KJE.Dropper("INPUTS2",false,j,h),KJE.colorList[0])};KJE.Capital.prototype.setValues=function(b){var a=KJE.inputs.items;b.ANNUAL_DESIRED_GROWTH=a.ANNUAL_DESIRED_GROWTH.getValue();b.TOTAL_CURRENT_ASSETS=a.TOTAL_CURRENT_ASSETS.getValue();b.TOTAL_CURRENT_LIABILITIES=a.TOTAL_CURRENT_LIABILITIES.getValue();b.TARGET_CURRENT_RATIO=a.TARGET_CURRENT_RATIO.getValue()};KJE.Capital.prototype.refresh=function(e){var d=KJE;var c=KJE.gLegend;var b=KJE.inputs.items;var a=KJE.gGraphs[0];KJE.setTitleTemplate(e.WORKING_CAPITAL_CHANGE);a.removeAll();a.setGraphCategories(e.cats);a.add(new KJE.gGraphDataSeries(e.WC_MONTH,this.MSG_LABEL4,a.getColor(1)));a.setTitleTemplate(d.dollars(e.WC_MONTH[e.MONTHS_OF_ANALYSIS-1]));a.paint();b.ACTUAL_CURRENT_RATIO.setText(d.number(e.ACTUAL_CURRENT_RATIO,2));b.ACTUAL_WORKING_CAPITAL.setText(d.dollars(e.ACTUAL_WORKING_CAPITAL));b.TARGET_WORKING_CAPITAL.setText(d.dollars(e.TARGET_WORKING_CAPITAL))};KJE.InputScreenText=" <div id=KJE-D-INPUTS><div id=KJE-P-INPUTS>Input information:</div></div> <div id=KJE-E-INPUTS > <div id='KJE-C-ANNUAL_DESIRED_GROWTH'><input id='KJE-ANNUAL_DESIRED_GROWTH' /></div> <div id='KJE-C-TARGET_CURRENT_RATIO'><input id='KJE-TARGET_CURRENT_RATIO' /></div> <div id='KJE-C-TOTAL_CURRENT_ASSETS'><input id='KJE-TOTAL_CURRENT_ASSETS' /></div> <div id='KJE-C-TOTAL_CURRENT_LIABILITIES'><input id='KJE-TOTAL_CURRENT_LIABILITIES' /></div> <div style=\"height:10px\"></div> </div> <div id=KJE-D-INPUTS2><div id=KJE-P-INPUTS2>Input information:</div></div> <div id=KJE-E-INPUTS2 > <div id='KJE-C-ACTUAL_CURRENT_RATIO'><div id='KJE-ACTUAL_CURRENT_RATIO'></div></div> <div id='KJE-C-ACTUAL_WORKING_CAPITAL'><div id='KJE-ACTUAL_WORKING_CAPITAL'></div></div> <div id='KJE-C-TARGET_WORKING_CAPITAL'><div id='KJE-TARGET_WORKING_CAPITAL'></div></div> <div style=\"height:10px\"></div> </div> **GRAPH1** ";KJE.DefinitionText=" <div id='KJE-D-ANNUAL_DESIRED_GROWTH' ><dt>Annual growth</dt><dd>The percent of growth you expect over the next year.</dd></div> <div id='KJE-D-TOTAL_CURRENT_ASSETS' ><dt>Total current assets</dt><dd>This is any cash or asset that can be quickly turned into cash. This includes prepaid expenses, accounts receivable, most securities and your inventory.</dd></div> <div id='KJE-D-TOTAL_CURRENT_LIABILITIES' ><dt>Total current liabilities</dt><dd>This is a liability in the immediate future. This includes wages, taxes and accounts payable.</dd></div> <div id='KJE-D-TARGET_CURRENT_RATIO' ><dt>Current ratio</dt><dd>Current Assets divided by current liabilities. Your current ratio helps you determine if you have enough working capital to meet your short-term financial obligations. A general rule of thumb is to have a current ratio of 2.0. Although this will vary by business and industry, a number above two may indicate a poor use of capital. A current ratio under two may indicate an inability to pay current financial obligations with a measure of safety.</dd></div> <div id='KJE-D-ACTUAL_WORKING_CAPITAL' ><dt>Working capital</dt><dd>Working capital is used by lenders to help gauge the ability for a company to weather difficult financial periods. Working capital is calculated by subtracting current liabilities from current assets. Due to differences in businesses and the fact that working capital is not a ratio but an absolute amount, it is difficult to predict what the ideal amount of working capital would be for your business. To calculate working capital requirements this calculator uses the 'Current Ratio' to determine a target amount of working capital. See the 'Current Ratio' definition for more information.</dd></div> ";KJE.ReportText=' <!--HEADING "Working Capital Needs" HEADING--> <h2 class=\'KJEReportHeader KJEFontHeading\'>WORKING_CAPITAL_CHANGE</h2>To maintain a current ratio of TARGET_CURRENT_RATIO you need a total of TARGET_WORKING_CAPITAL in working capital. Your actual working capital is ACTUAL_WORKING_CAPITAL with a current ratio of ACTUAL_CURRENT_RATIO. If you grow ANNUAL_DESIRED_GROWTH per year in MONTHS_OF_ANALYSIS months you will need TARGET_WORKING_CAPITAL_END of working capital. This will keep your current ratio at TARGET_CURRENT_RATIO. This assumes that both your current liabilities and current assets increase at an annual rate of ANNUAL_DESIRED_GROWTH. **GRAPH** <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>Results Summary</caption> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder KJECell40">&nbsp;</th><td class="KJECellStrong KJECellBorder KJECell20">Actuals</td><td class="KJECellStrong KJECellBorder KJECell20">Target Month 1</td><td class="KJECellStrong KJECell20">Target Month MONTHS_OF_ANALYSIS</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Current ratio </th><td class="KJECell KJECellBorder">ACTUAL_CURRENT_RATIO </td> <td class="KJECell KJECellBorder">TARGET_CURRENT_RATIO </td><td class="KJECell">TARGET_CURRENT_RATIO </td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Working capital </th><td class="KJECell KJECellBorder">ACTUAL_WORKING_CAPITAL</td><td class="KJECell KJECellBorder">TARGET_WORKING_CAPITAL</td><td class="KJECell">TARGET_WORKING_CAPITAL_END</td></tr></table> </div> <BR> <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>Input Summary</caption> <tr class=KJEOddRow><th class="KJELabel KJECellBorder KJECell60">Total current assets </th><td class="KJECell KJECell40">TOTAL_CURRENT_ASSETS </td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Total current liabilities </th><td class="KJECell">TOTAL_CURRENT_LIABILITIES </td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Annual growth rate </th><td class="KJECell">ANNUAL_DESIRED_GROWTH </td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Current ratio target </th><td class="KJECell">TARGET_CURRENT_RATIO </td></tr></table> </div> <h2 class=\'KJEScheduleHeader KJEFontHeading\'>Working capital estimates for the next MONTHS_OF_ANALYSIS months</h2> **REPEATING GROUP** <BR> <P class=KJEFooter>*Required total assets to meet current ratio target of TARGET_CURRENT_RATIO </P> ';