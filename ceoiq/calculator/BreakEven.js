KJE.BreakEvenCalc=function(){this.bVerbose=false;this.BREAK_EVEN_LABEL="";this.MSG_AXIS_LABEL=KJE.parameters.get("MSG_AXIS_LABEL","Sales Volume");this.MSG_NOBREAKEVEN=KJE.parameters.get("MSG_NOBREAKEVEN","You have no break even sales volume.");this.MSG_BREAKEVEN=KJE.parameters.get("MSG_BREAKEVEN","You will break even at KJE1 units.");this.MSG_BREAKEVEN_LONG=KJE.parameters.get("MSG_BREAKEVEN_LONG","Your break even sales volume is KJE1 units. At this level, the revenue generated from your sales will cover the total of your fixed and variable costs.");this.MSG_ERR_TOTAL_REVENUE=KJE.parameters.get("MSG_ERR_TOTAL_REVENUE","Total revenue cannot exceed 1,000 billion.");this.MSG_LEGEND_TOTAL_COST=KJE.parameters.get("MSG_LEGEND_TOTAL_COST","Total Cost");this.MSG_LEGEND_TOTAL_REVENUE=KJE.parameters.get("MSG_LEGEND_TOTAL_REVENUE","Total Revenue");this.MSG_LEGEND_FIXED_COST=KJE.parameters.get("MSG_LEGEND_FIXED_COST","Fixed Cost");this.sSchedule=new KJE.Repeating()};KJE.BreakEvenCalc.prototype.clear=function(){this.VARIABLE_UNIT_COST=0;this.FIXED_COST=0;this.EXPECTED_UNIT_SALES=0;this.PRICE=0};KJE.BreakEvenCalc.prototype.calculate=function(p){var g=KJE;var e=this.VARIABLE_UNIT_COST;var m=this.FIXED_COST;var l=this.EXPECTED_UNIT_SALES;var f=this.PRICE;var j=0;if(l*f>1000000000000){throw (this.MSG_ERR_TOTAL_REVENUE)}var o=l*f;var k=l*e;var h=k+m;var b=o-h;if(f-e<0){j=-1;this.BREAK_EVEN_LABEL=this.MSG_NOBREAKEVEN}else{if(f-e==0&&m>0){j=-1;this.BREAK_EVEN_LABEL=this.MSG_NOBREAKEVEN}else{if(f-e==0&&m==0){j=0}else{j=m/(f-e)}if(!this.bVerbose){this.BREAK_EVEN_LABEL=KJE.getKJEReplaced(this.MSG_BREAKEVEN,g.number(j))}else{this.BREAK_EVEN_LABEL=KJE.getKJEReplaced(this.MSG_BREAKEVEN_LONG,g.number(j))}}}var a=1;var d=l;var q=0;if(d>100){while(d>100){d=(d/10);a*=10}}else{d=l}this.aFixedCost=KJE.FloatArray(d+1);this.aTotalRevenue=KJE.FloatArray(d+1);this.aTotalCost=KJE.FloatArray(d+1);this.sCats=new Array(d+1);if(p){var i=this.sSchedule;i.clearRepeat();i.addHeader(i.sReportCol("Units",1),i.sReportCol("Fixed Cost",2),i.sReportCol("Total Cost",3),i.sReportCol("Total Revenue",4),i.sReportCol("Profit",5))}for(var c=0;c<=d;c++){q=c*a;this.aFixedCost[c]=(m);this.aTotalRevenue[c]=(f*q);this.aTotalCost[c]=(e*q)+m;this.sCats[c]=""+(q);if(p){i.addRepeat(""+q,g.dollars(this.aFixedCost[c],2),g.dollars(this.aTotalCost[c],2),g.dollars(this.aTotalRevenue[c],2),g.dollars(this.aTotalRevenue[c]-this.aTotalCost[c],2))}}this.TOTAL_REVENUES=o;this.TOTAL_VARIABLE_COSTS=k;this.TOTAL_COSTS=h;this.PROFIT=b;this.BREAK_EVEN=j};KJE.BreakEvenCalc.prototype.formatReport=function(b){var c=KJE;var a=this.iDecimal;var d=b;d=KJE.replace("VARIABLE_UNIT_COST",c.dollars(this.VARIABLE_UNIT_COST,2),d);d=KJE.replace("FIXED_COST",c.dollars(this.FIXED_COST,2),d);d=KJE.replace("EXPECTED_UNIT_SALES",c.number(this.EXPECTED_UNIT_SALES),d);d=KJE.replace("PRICE",c.dollars(this.PRICE,2),d);d=KJE.replace("TOTAL_REVENUES",c.dollars(this.TOTAL_REVENUES,2),d);d=KJE.replace("TOTAL_VARIABLE_COSTS",c.dollars(this.TOTAL_VARIABLE_COSTS,2),d);d=KJE.replace("TOTAL_COSTS",c.dollars(this.TOTAL_COSTS,2),d);d=KJE.replace("PROFIT",c.dollars(this.PROFIT,2),d);d=KJE.replace("BREAK_EVEN_LABEL",this.BREAK_EVEN_LABEL,d);d=KJE.replace("BREAK_EVEN",c.number(this.BREAK_EVEN),d);d=d.replace("**REPEATING GROUP**",this.sSchedule.getRepeat());this.sSchedule.clearRepeat();return d};KJE.CalcName="Breakeven Analysis Calculator";KJE.CalcType="breakeven";KJE.CalculatorTitleTemplate="KJE1";KJE.parseInputs=function(a){return a};KJE.initialize=function(){KJE.CalcControl=new KJE.BreakEvenCalc();KJE.GuiControl=new KJE.BreakEven(KJE.CalcControl)};KJE.BreakEven=function(f){var e=KJE;var c=KJE.gLegend;var b=KJE.inputs.items;KJE.DollarSlider("VARIABLE_UNIT_COST","Variable unit cost",0,100000,2,0,7);KJE.DollarSlider("FIXED_COST","Fixed cost",0,1000000000,0,0,5);KJE.Slider("EXPECTED_UNIT_SALES","Expected unit sales",0,10000000,0,KJE.FMT_NUMBER,0,[KJE.number(0)+"k",KJE.number(200)+"k",KJE.number(500)+"k",KJE.number(1)+"m"],new KJE.MakeScale(0,200000,500000,1000000,5000,10000,20000));KJE.DollarSlider("PRICE","Price per unit",0,1000000,2,0,7);var a=KJE.gNewGraph(KJE.gLINE,"GRAPH1",true,false,KJE.colorList[1],KJE.parameters.get("MSG_GRAPH_TITLE","Profit by Sales Volume"));a._legend._iOrientation=(c.TOP_RIGHT);var d=KJE.parameters.get("MSG_DROPPER_TITLE","Break even analysis inputs:");KJE.addDropper(new KJE.Dropper("INPUTS",true,d,d),KJE.colorList[0])};KJE.BreakEven.prototype.setValues=function(b){var a=KJE.inputs.items;b.VARIABLE_UNIT_COST=a.VARIABLE_UNIT_COST.getValue();b.FIXED_COST=a.FIXED_COST.getValue();b.EXPECTED_UNIT_SALES=a.EXPECTED_UNIT_SALES.getValue();b.PRICE=a.PRICE.getValue()};KJE.BreakEven.prototype.refresh=function(e){var d=KJE;var c=KJE.gLegend;var b=KJE.inputs.items;var a=KJE.gGraphs[0];KJE.setTitleTemplate(e.BREAK_EVEN_LABEL);a.removeAll();a.setGraphCategories(e.sCats);a.add(new KJE.gGraphDataSeries(e.aTotalCost,e.MSG_LEGEND_TOTAL_COST,a.getColor(1)));a.add(new KJE.gGraphDataSeries(e.aTotalRevenue,e.MSG_LEGEND_TOTAL_REVENUE,a.getColor(2)));a.add(new KJE.gGraphDataSeries(e.aFixedCost,e.MSG_LEGEND_FIXED_COST,a.getColor(3)));a._titleXAxis.setText(e.MSG_AXIS_LABEL);a.paint()};KJE.InputScreenText=" <div id=KJE-D-INPUTS><div id=KJE-P-INPUTS>Input information:</div></div> <div id=KJE-E-INPUTS > <div id='KJE-C-EXPECTED_UNIT_SALES'><input id='KJE-EXPECTED_UNIT_SALES' /></div> <div id='KJE-C-FIXED_COST'><input id='KJE-FIXED_COST' /></div> <div id='KJE-C-PRICE'><input id='KJE-PRICE' /></div> <div id='KJE-C-VARIABLE_UNIT_COST'><input id='KJE-VARIABLE_UNIT_COST' /></div> <div id='KJE-C-BLANK'><div id='KJE-BLANK'></div></div> <div id='KJE-C-BREAK_EVEN'><div id='KJE-BREAK_EVEN'></div></div> <div id='KJE-C-PROFIT'><div id='KJE-PROFIT'></div></div> <div id='KJE-C-TOTAL_COSTS'><div id='KJE-TOTAL_COSTS'></div></div> <div id='KJE-C-TOTAL_REVENUES'><div id='KJE-TOTAL_REVENUES'></div></div> <div id='KJE-C-TOTAL_VARIABLE_COSTS'><div id='KJE-TOTAL_VARIABLE_COSTS'></div></div> <div style=\"height:10px\"></div> </div> **GRAPH1** ";KJE.DefinitionText=" <div id='KJE-D-VARIABLE_UNIT_COST' ><dt>Variable unit cost</dt><dd>Cost associated with producing an additional unit.</dd></div> <div id='KJE-D-FIXED_COST' ><dt>Fixed cost</dt><dd>The sum of all costs required to produce any product. This amount does not change as production increases or decreases.</dd></div> <div id='KJE-D-EXPECTED_UNIT_SALES' ><dt>Expected unit sales</dt><dd>The number of units that are expected to be sold.</dd></div> <div id='KJE-D-PRICE' ><dt>Price per unit</dt><dd>Price you will be able to receive per unit.</dd></div> <div id='KJE-D-TOTAL_VARIABLE_COSTS' ><dt>Total variable costs</dt><dd>The product of units produced and variable unit cost (example 10 units at $5 variable cost produces a total variable cost of $50).</dd></div> <div id='KJE-D-TOTAL_COSTS' ><dt>Total costs</dt><dd>Sum of fixed costs and variable costs.</dd></div> <div id='KJE-D-TOTAL_REVENUES' ><dt>Total revenue</dt><dd>Product of price and expected sale unit sales (example 10 units at $10 equals $100 total revenue).</dd></div> <div id='KJE-D-PROFIT' ><dt>Profit</dt><dd>Total revenue minus total costs.</dd></div> <div id='KJE-D-BREAK_EVEN' ><dt>Break-even</dt><dd>Number of units required to sell to make a profit of zero.</dd></div> ";KJE.ReportText=' <!--HEADING " Sales Volume Break Even Analysis" HEADING--> <h2 class=\'KJEReportHeader KJEFontHeading\'>BREAK_EVEN_LABEL</h2>**GRAPH**<p>Your break even point is where your profit equals zero. As long as your gross margin is greater than zero, every unit sold after you have reached your break even point will add to your profitability. If your gross margin is less than zero, regardless of the units sold, there is no break even point. <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>Break Even Analysis Summary</caption> <tr class=KJEOddRow><th class="KJELabel KJECellBorder KJECell50" >Variable Cost</th><td class="KJECell" >VARIABLE_UNIT_COST per unit</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Fixed Cost</th><td class="KJECell" >FIXED_COST</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Expected Sales</th><td class="KJECell" >EXPECTED_UNIT_SALES units</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Price</th><td class="KJECell" >PRICE per unit</td></tr> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder">Total Revenue</th><td class="KJECellStrong" >TOTAL_REVENUES</td></tr> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder">Total Variable Costs</th><td class="KJECellStrong" >TOTAL_VARIABLE_COSTS</td></tr> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder">Profit</th><td class="KJECellStrong" >PROFIT</td></tr></table> </div> <h2 class=\'KJEScheduleHeader KJEFontHeading\'>Profit by Units Sold</h2> **REPEATING GROUP** ';