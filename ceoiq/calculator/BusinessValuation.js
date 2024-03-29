KJE.BusinessValuationCalc=function(){this.YEARS_OF_CASHFLOWS=1;this.PROJECT_YEARS=100;this.OPERATING_PROFIT=0;this.INTEREST_EXPENSE=0;this.INTEREST_INCOME=0;this.INCOME_TAXES=0;this.DEPRECIATION_AND_AMORTIZATION=0;this.CASH_FLOW_FROM_OPERATIONS=0;this.CHANGE_IN_NOTES_PAYABLE=0;this.CHANGE_IN_INVENTORY=0;this.CHANGE_IN_ACCOUNTS_RECEIVABLE=0;this.CHANGES_IN_OPERATING_ASSETS_LIABILITIES=0;this.OTHER_NET_CHANGE=0;this.NET_CASH_FLOW_FOR_OPERATIONS=0;this.CAPITAL_EXPENDITURES=0;this.OTHER_NET_AMOUNT=0;this.CASH_FLOW_FROM_INVESTMENT_ACTVITIES=0;this.NET_CASH_FLOW=0;this.MSG_XAXIS_TITLE=KJE.parameters.get("MSG_XAXIS_TITLE","A higher growth rate can dramatically increase value.");this.MSG_GRAPH_TITLE=KJE.parameters.get("MSG_GRAPH_TITLE","How Growth Affects Business Valuation");this.MSG_ERROR1=KJE.parameters.get("MSG_ERROR1","Net cash flow can't be negative for this calculation.");this.GROWTH_AMT=KJE.FloatArray(3);this.cats=new Array(3);this.sSchedule=new KJE.Repeating()};KJE.BusinessValuationCalc.prototype.clear=function(){this.YEAR_TO_START=0;this.EXPECTED_ANNUAL_GROWTH=0;this.WEIGHTED_AVERAGE_COST_OF_CAPITAL=0};KJE.BusinessValuationCalc.prototype.calculate=function(j){var d=KJE;var a=this.YEAR_TO_START;var h=this.EXPECTED_ANNUAL_GROWTH/100;var b=this.WEIGHTED_AVERAGE_COST_OF_CAPITAL/100;var g=this.PROJECT_YEARS;this.CASH_FLOW_FROM_OPERATIONS=this.OPERATING_PROFIT+this.INTEREST_INCOME+ +this.DEPRECIATION_AND_AMORTIZATION-this.INCOME_TAXES-this.INTEREST_EXPENSE;this.CHANGES_IN_OPERATING_ASSETS_LIABILITIES=this.CHANGE_IN_NOTES_PAYABLE+this.OTHER_NET_CHANGE-this.CHANGE_IN_INVENTORY-this.CHANGE_IN_ACCOUNTS_RECEIVABLE;this.NET_CASH_FLOW_FOR_OPERATIONS=this.CASH_FLOW_FROM_OPERATIONS+this.CHANGES_IN_OPERATING_ASSETS_LIABILITIES;this.CASH_FLOW_FROM_INVESTMENT_ACTVITIES=this.OTHER_NET_AMOUNT-this.CAPITAL_EXPENDITURES;this.NET_CASH_FLOW=this.NET_CASH_FLOW_FOR_OPERATIONS+this.CASH_FLOW_FROM_INVESTMENT_ACTVITIES;if(this.NET_CASH_FLOW<0){throw this.MSG_ERROR1}this.NET_CASH_NPV1=KJE.NPV_AMT(b,1,this.NET_CASH_FLOW);var e=this.NET_CASH_NPV1;this.NET_CASH_FLOW2=(h+1)*this.NET_CASH_FLOW;this.NET_CASH_FLOW3=(h+1)*this.NET_CASH_FLOW2;this.NET_CASH_FLOW4=(h+1)*this.NET_CASH_FLOW3;this.NET_CASH_NPV2=KJE.NPV_AMT(b,2,this.NET_CASH_FLOW2);this.NET_CASH_NPV3=KJE.NPV_AMT(b,3,this.NET_CASH_FLOW3);this.NET_CASH_NPV4=KJE.NPV_AMT(b,4,this.NET_CASH_FLOW4);this.GROWTH_AMT[0]=e;this.GROWTH_AMT[1]=e;this.GROWTH_AMT[2]=e;var f=this.NET_CASH_FLOW;if(f>0){for(var c=this.YEARS_OF_CASHFLOWS;c<g;c++){f*=(1+h);this.GROWTH_AMT[0]+=KJE.NPV_AMT(b,c+1,f)}f=this.NET_CASH_FLOW;for(var c=this.YEARS_OF_CASHFLOWS;c<g;c++){f*=(1+(h+0.01));this.GROWTH_AMT[1]+=KJE.NPV_AMT(b,c+1,f)}f=this.NET_CASH_FLOW;for(var c=this.YEARS_OF_CASHFLOWS;c<g;c++){f*=(1+(h+0.02));this.GROWTH_AMT[2]+=KJE.NPV_AMT(b,c+1,f)}}e=this.GROWTH_AMT[0];this.cats[0]=d.percent((h),1);this.cats[1]=d.percent((h+0.01),1);this.cats[2]=d.percent((h+0.02),1);this.NPV=e};KJE.BusinessValuationCalc.prototype.formatReport=function(b){var c=KJE;var a=this.iDecimal;var d=b;d=KJE.replace("PROJECT_YEARS",c.number(this.PROJECT_YEARS),d);d=KJE.replace("PROJECT_ADDITIONAL_YEARS",c.number(this.PROJECT_YEARS-1),d);d=KJE.replace("OPERATING_PROFIT",c.dollars(this.OPERATING_PROFIT),d);d=KJE.replace("INTEREST_EXPENSE",c.dollars(this.INTEREST_EXPENSE),d);d=KJE.replace("INTEREST_INCOME",c.dollars(this.INTEREST_INCOME),d);d=KJE.replace("INCOME_TAXES",c.dollars(this.INCOME_TAXES),d);d=KJE.replace("DEPRECIATION_AND_AMORTIZATION",c.dollars(this.DEPRECIATION_AND_AMORTIZATION),d);d=KJE.replace("CASH_FLOW_FROM_OPERATIONS",c.dollars(this.CASH_FLOW_FROM_OPERATIONS),d);d=KJE.replace("CHANGE_IN_NOTES_PAYABLE",c.dollars(this.CHANGE_IN_NOTES_PAYABLE),d);d=KJE.replace("CHANGE_IN_INVENTORY",c.dollars(this.CHANGE_IN_INVENTORY),d);d=KJE.replace("CHANGE_IN_ACCOUNTS_RECEIVABLE",c.dollars(this.CHANGE_IN_ACCOUNTS_RECEIVABLE),d);d=KJE.replace("CHANGES_IN_OPERATING_ASSETS_LIABILITIES",c.dollars(this.CHANGES_IN_OPERATING_ASSETS_LIABILITIES),d);d=KJE.replace("OTHER_NET_CHANGE",c.dollars(this.OTHER_NET_CHANGE),d);d=KJE.replace("NET_CASH_FLOW_FOR_OPERATIONS",c.dollars(this.NET_CASH_FLOW_FOR_OPERATIONS),d);d=KJE.replace("CAPITAL_EXPENDITURES",c.dollars(this.CAPITAL_EXPENDITURES),d);d=KJE.replace("OTHER_NET_AMOUNT",c.dollars(this.OTHER_NET_AMOUNT),d);d=KJE.replace("CASH_FLOW_FROM_INVESTMENT_ACTVITIES",c.dollars(this.CASH_FLOW_FROM_INVESTMENT_ACTVITIES),d);d=KJE.replace("NET_CASH_FLOW2",c.dollars(this.NET_CASH_FLOW2),d);d=KJE.replace("NET_CASH_FLOW3",c.dollars(this.NET_CASH_FLOW3),d);d=KJE.replace("NET_CASH_FLOW4",c.dollars(this.NET_CASH_FLOW4),d);d=KJE.replace("NET_CASH_FLOW",c.dollars(this.NET_CASH_FLOW),d);d=KJE.replace("NET_CASH_NPV1",c.dollars(this.NET_CASH_NPV1),d);d=KJE.replace("NET_CASH_NPV2",c.dollars(this.NET_CASH_NPV2),d);d=KJE.replace("NET_CASH_NPV3",c.dollars(this.NET_CASH_NPV3),d);d=KJE.replace("NET_CASH_NPV4",c.dollars(this.NET_CASH_NPV4),d);d=KJE.replace("EXPECTED_ANNUAL_GROWTH",c.percent(this.EXPECTED_ANNUAL_GROWTH/100,2),d);d=KJE.replace("WEIGHTED_AVERAGE_COST_OF_CAPITAL",c.percent(this.WEIGHTED_AVERAGE_COST_OF_CAPITAL/100,2),d);d=KJE.replace("NPV_VALUE",c.dollars(this.NPV),d);i=0;for(var e=0;e<3;e++){i=e+1;d=KJE.replace("GR_RATE"+i,c.percent((this.EXPECTED_ANNUAL_GROWTH+e)/100,2),d);d=KJE.replace("VALUE_RATE"+i,c.dollars(this.GROWTH_AMT[e]),d)}return d};KJE.CalcName="Business Valuation - Discounted Cash Flow Calculator";KJE.CalcType="businessvaluation";KJE.CalculatorTitleTemplate="The business NPV is valued at KJE1.";KJE.parameters.set("PROJECT_YEARS",50);KJE.parseInputs=function(a){return a};KJE.initialize=function(){KJE.CalcControl=new KJE.BusinessValuationCalc();KJE.GuiControl=new KJE.BusinessValuation(KJE.CalcControl)};KJE.BusinessValuation=function(j){var e=KJE;var a=KJE.gLegend;var f=KJE.inputs.items;var d=KJE.parameters.get("MSG_PLUS_SIGN","(+)");var n=KJE.parameters.get("MSG_MINUS_SIGN","(-)");KJE.DollarSlider("OPERATING_PROFIT","Operating profit",-10000000000,10000000000,0,0,4);KJE.DollarSlider("INTEREST_EXPENSE","Interest expense",-10000000000,10000000000,0,0,4);KJE.DollarSlider("INTEREST_INCOME","Interest income",-10000000000,10000000000,0,0,4);KJE.DollarSlider("INCOME_TAXES","Income taxes",-10000000000,10000000000,0,0,4);KJE.DollarSlider("DEPRECIATION_AND_AMORTIZATION","Depreciation and amortization",-10000000000,10000000000,0,0,4);KJE.DollarSlider("CHANGE_IN_NOTES_PAYABLE","Change in accounts payable",-10000000000,10000000000,0,0,4);KJE.DollarSlider("CHANGE_IN_INVENTORY","Change in inventory",-10000000000,10000000000,0,0,4);KJE.DollarSlider("CHANGE_IN_ACCOUNTS_RECEIVABLE","Change in accounts receivable",-10000000000,10000000000,0,0,4);KJE.DollarSlider("OTHER_NET_CHANGE","Other net change",-10000000000,10000000000,0,0,4);KJE.DollarSlider("CAPITAL_EXPENDITURES","Capital expenditures",-10000000000,10000000000,0,0,4);KJE.DollarSlider("OTHER_NET_AMOUNT","Additional investment income",-10000000000,10000000000,0,0,4);KJE.Label("NET_CASH_FLOW","Net cash flow");KJE.Label("NPV","Business NPV");KJE.PercentSlider("EXPECTED_ANNUAL_GROWTH","Expected annual growth",0,40,2);KJE.PercentSlider("WEIGHTED_AVERAGE_COST_OF_CAPITAL","Weighted average cost of capital",5,100,2);KJE.NumberSlider("PROJECT_YEARS","Years of cash flow to include",1,100);var g=KJE.gNewGraph(KJE.gCATEGORIES,"GRAPH1",true,false,KJE.colorList[1],j.MSG_GRAPH_TITLE);g._legend.setVisible(false);g._showItemLabel=true;g._showItemLabelOnTop=true;g._axisX._fSpacingPercent=0.25;g._titleXAxis.setText(j.MSG_XAXIS_TITLE);g._bPopDetail=true;var m=KJE.parameters.get("MSG_WINTITLE_OPERATIONS","Cash flow from operations:");var k=KJE.parameters.get("MSG_WINTITLE_FINANCE","Cash flows from investing:");KJE.addDiv("OVERVIEW",KJE.colorList[0]);var b=KJE.parameters.get("MSG_DROPPER_CLOSETITLE","KJE1");var c=function(){return m+"|"+KJE.subText(KJE.getKJEReplaced(b,e.dollars(j.NET_CASH_FLOW_FOR_OPERATIONS)),"KJERightBold")};KJE.addDropper(new KJE.Dropper("INPUTS",false,c,c),KJE.colorList[0]);var h=function(){return k+"|"+KJE.subText(KJE.getKJEReplaced(b,e.dollars(j.CASH_FLOW_FROM_INVESTMENT_ACTVITIES)),"KJERightBold")};KJE.addDropper(new KJE.Dropper("INPUTS2",false,h,h),KJE.colorList[0])};KJE.BusinessValuation.prototype.setValues=function(b){var a=KJE.inputs.items;b.OPERATING_PROFIT=a.OPERATING_PROFIT.getValue();b.INTEREST_EXPENSE=a.INTEREST_EXPENSE.getValue();b.INTEREST_INCOME=a.INTEREST_INCOME.getValue();b.INCOME_TAXES=a.INCOME_TAXES.getValue();b.DEPRECIATION_AND_AMORTIZATION=a.DEPRECIATION_AND_AMORTIZATION.getValue();b.CHANGE_IN_NOTES_PAYABLE=a.CHANGE_IN_NOTES_PAYABLE.getValue();b.CHANGE_IN_INVENTORY=a.CHANGE_IN_INVENTORY.getValue();b.CHANGE_IN_ACCOUNTS_RECEIVABLE=a.CHANGE_IN_ACCOUNTS_RECEIVABLE.getValue();b.OTHER_NET_CHANGE=a.OTHER_NET_CHANGE.getValue();b.CAPITAL_EXPENDITURES=a.CAPITAL_EXPENDITURES.getValue();b.OTHER_NET_AMOUNT=a.OTHER_NET_AMOUNT.getValue();b.EXPECTED_ANNUAL_GROWTH=a.EXPECTED_ANNUAL_GROWTH.getValue();b.WEIGHTED_AVERAGE_COST_OF_CAPITAL=a.WEIGHTED_AVERAGE_COST_OF_CAPITAL.getValue();b.PROJECT_YEARS=a.PROJECT_YEARS.getValue()};KJE.BusinessValuation.prototype.refresh=function(e){var d=KJE;var c=KJE.gLegend;var b=KJE.inputs.items;var a=KJE.gGraphs[0];KJE.setTitleTemplate(d.dollars(e.NPV));a.removeAll();a.setGraphCategories(e.cats);a.add(new KJE.gGraphDataSeries(e.GROWTH_AMT,"",a.getColor(1)));a._axisY._bAutoMinimum=(e.GROWTH_AMT[0]>0?false:true);a._axisY._bAutoMaximum=true;a.paint();b.NPV.setText(d.dollars(e.NPV));b.NET_CASH_FLOW.setText(d.dollars(e.NET_CASH_FLOW))};KJE.InputScreenText=" <div id=KJE-D-OVERVIEW> <div id='KJE-C-EXPECTED_ANNUAL_GROWTH'><input id='KJE-EXPECTED_ANNUAL_GROWTH' /></div> <div id='KJE-C-WEIGHTED_AVERAGE_COST_OF_CAPITAL'><input id='KJE-WEIGHTED_AVERAGE_COST_OF_CAPITAL' /></div> <div id='KJE-C-NET_CASH_FLOW'><div id='KJE-NET_CASH_FLOW'></div></div> <div id='KJE-C-PROJECT_YEARS'><input id='KJE-PROJECT_YEARS'/></div> <div style=\"height:10px\"></div> </div> <div id=KJE-D-INPUTS><div id=KJE-P-INPUTS>Input information:</div></div> <div id=KJE-E-INPUTS > <div id='KJE-C-OPERATING_PROFIT'><input id='KJE-OPERATING_PROFIT' /></div> <div id='KJE-C-INTEREST_EXPENSE'><input id='KJE-INTEREST_EXPENSE' /></div> <div id='KJE-C-INTEREST_INCOME'><input id='KJE-INTEREST_INCOME' /></div> <div id='KJE-C-DEPRECIATION_AND_AMORTIZATION'><input id='KJE-DEPRECIATION_AND_AMORTIZATION' /></div> <div id='KJE-C-INCOME_TAXES'><input id='KJE-INCOME_TAXES' /></div> <div id='KJE-C-CHANGE_IN_INVENTORY'><input id='KJE-CHANGE_IN_INVENTORY' /></div> <div id='KJE-C-CHANGE_IN_NOTES_PAYABLE'><input id='KJE-CHANGE_IN_NOTES_PAYABLE' /></div> <div id='KJE-C-CHANGE_IN_ACCOUNTS_RECEIVABLE'><input id='KJE-CHANGE_IN_ACCOUNTS_RECEIVABLE' /></div> <div id='KJE-C-OTHER_NET_CHANGE'><input id='KJE-OTHER_NET_CHANGE' /></div> <div style=\"height:10px\"></div> </div> <div id=KJE-D-INPUTS2><div id=KJE-P-INPUTS2>Input information:</div></div> <div id=KJE-E-INPUTS2 > <div id='KJE-C-CAPITAL_EXPENDITURES'><input id='KJE-CAPITAL_EXPENDITURES' /></div> <div id='KJE-C-OTHER_NET_AMOUNT'><input id='KJE-OTHER_NET_AMOUNT' /></div> <div style=\"height:10px\"></div> </div> **GRAPH1** ";KJE.DefinitionText=" <div id='KJE-D-NPV' ><dt>NPV Value of your business</dt><dd>This is the value of all of your future cash flows discounted in today's dollars at your Weighted Average Cost of Capital (WACC).</dd></div> <div id='KJE-D-EXPECTED_ANNUAL_GROWTH' ><dt>Expected annual growth</dt><dd>This is the rate you expect your business to grow. This rate is only used on years 2 and above to estimate your future cash flow.</dd></div> <div id='KJE-D-WEIGHTED_AVERAGE_COST_OF_CAPITAL' ><dt>Weighted average cost of capital (WACC)</dt><dd>This is the cost of capital, or the interest rate, your investors require to put money into your business. Unless you are a Fortune 500 company with excellent business credit scores, this rate should be at least 12% to 25%. For small businesses that rate can be much higher.</dd></div> <div id='KJE-D-PROJECT_YEARS' ><dt>Years of cash flow to include</dt><dd>This is the number of years that the projection will include in the value of your business. For example, if you include 100 years (the maximum) we calculate the present value of all future cash flows generated for the next 100 years into your business' value. Entering a high number would assume that the business would continue with the current projections for that entire length of time. You may wish to reduce this projected period if you have a known end date for the business cash flows, or to make a more conservative estimate of the value.</dd></div> <div id='KJE-D-OPERATING_PROFIT' ><dt>Operating profit</dt><dd>This is your total profit before interest and taxes. This is often called Earnings Before Interest and Taxes or EBIT.</dd></div> <div id='KJE-D-INTEREST_EXPENSE' ><dt>Interest expense</dt><dd>Total interest expense for the year.</dd></div> <div id='KJE-D-INTEREST_INCOME' ><dt>Interest income</dt><dd>Total interest income for the year.</dd></div> <div id='KJE-D-INCOME_TAXES' ><dt>Income taxes</dt><dd>Total income taxes paid for the year.</dd></div> <div id='KJE-D-DEPRECIATION_AND_AMORTIZATION' ><dt>Depreciation and amortization</dt><dd>If you had any depreciation on equipment or buildings enter those amounts here. They are added back into your cash flow.</dd></div> <div id='KJE-D-CHANGE_IN_NOTES_PAYABLE' ><dt>Change in accounts payable</dt><dd>If you had a net change in your accounts payable, enter the change here. If you had an increase in accounts payable, your cash flow goes up. If you had a decrease in your accounts payable, your cash flow is reduced.</dd></div> <div id='KJE-D-CHANGE_IN_INVENTORY' ><dt>Change in inventory</dt><dd>If you had a net change in your inventory, enter that amount here. If you are holding more inventory your cash flow is decreased.</dd></div> <div id='KJE-D-CHANGE_IN_ACCOUNTS_RECEIVABLE' ><dt>Change in accounts receivable</dt><dd>If you had a net change in your accounts receivable, enter that amount here. Reducing your accounts receivable by collecting money owed more quickly can increase your cash flow and your valuation.</dd></div> <div id='KJE-D-OTHER_NET_CHANGE' ><dt>Other net change</dt><dd>Enter any other net change in other assets or liabilities that impacted your cash flow for the period.</dd></div> <div id='KJE-D-CAPITAL_EXPENDITURES' ><dt>Capital expenditures</dt><dd>This is the amount you spent on capital equipment and buildings that you were not able to expense for the period. If you were able to expense the expenditure, it is already accounted for in your EBIT.</dd></div> <div id='KJE-D-OTHER_NET_AMOUNT' ><dt>Additional investment income</dt><dd>Enter any other investment that increased or (decreased) your cash flow for the period.</dd></div> ";KJE.ReportText=' <!--HEADING "Business Valuation Results" HEADING--> <h2 class=\'KJEReportHeader KJEFontHeading\'>The estimated Net Present Value (NPV) of your business is NPV_VALUE.</h2> Your cash flow was estimated in two parts. First from your cash flow statement, and secondly from projecting future cash flows assuming a growth of EXPECTED_ANNUAL_GROWTH. We first calculated your estimated cash flow for year one from your inputs. An additional PROJECT_ADDITIONAL_YEARS years of cash flows were calculated assuming a EXPECTED_ANNUAL_GROWTH annual growth (for a total of PROJECT_YEARS). Each year\'s estimated cash flow was then discounted by WEIGHTED_AVERAGE_COST_OF_CAPITAL (your weighted average cost of capital) for the number of years until the cash flow would be realized. The sum of all of your future discounted cash flows is the net present value of your business. **GRAPH** <h2 class=\'KJEReportHeader KJEFontHeading\'>What else can I do to increase my valuation?</h2> <ul> <li><strong>Increase your operating profits:</strong> <br>You can directly impact your valuation by becoming more profitable. Increased efficiency and lower operating expenses can have a dramatic impact on your business\' valuation. Even relatively small increases in profitability can have a dramatic impact on your valuation.<p> <li><strong>Reduce inventory and accounts receivable:</strong> <br>By reducing your inventory and accounts receivable, you can decrease the amount of capital that is tied up in your business. The net change directly affects your valuation.<p> <li><strong>Reduce your taxes:</strong> <br>Very much like reducing your inventory, reducing your tax burden can directly impact the value of your business. A business that creates effective tax shields can be worth substantially more than one that doesn\'t consider this important variable.<p> <li><strong>Effective capital expenditures:</strong> <br>Target your capital expenditures to projects that increase your growth rate, or increase your profitability. While capital expenditures reduce your near-term cash flow, effective investment in your business can have a positive impact in your valuation. </ul> <h2 class=\'KJEReportHeader KJEFontHeading\'>Your cash flow statement:</h2> <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>Net Cash flow*</caption> <thead class=\'KJEReportTHeader\'> <tr class=KJEHeaderRow><td class="KJEHeading KJECell20">&nbsp;</td><th class="KJEHeading KJECell20" scope=\'col\'>Year 1</th><th class="KJEHeading KJECell20" scope=\'col\'>Year 2</th><th class="KJEHeading KJECell20" scope=\'col\'>Year 3</th><th class="KJEHeading KJECell20" scope=\'col\'>Year 4</th></tr> </thead> <tbody class=\'KJEReportTBody\'> <tr class=KJEOddRow><th class="KJELabel KJECellBorder" scope=\'row\'>Net cash flow </th><td class="KJELabel KJECellBorder">NET_CASH_FLOW</td><td class="KJELabel KJECellBorder">NET_CASH_FLOW2</td><td class="KJELabel KJECellBorder">NET_CASH_FLOW3</td><td class="KJELabel">NET_CASH_FLOW4</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder" scope=\'row\'>Net cash flow NPV </th><td class="KJELabel KJECellBorder">NET_CASH_NPV1</td><td class="KJELabel KJECellBorder">NET_CASH_NPV2</td><td class="KJELabel KJECellBorder">NET_CASH_NPV3</td><td class="KJELabel">NET_CASH_NPV4</td></tr> </tfoot> </table> </div> <div class=KJEFooter align=center>*Years 2-PROJECT_YEARS estimates assuming EXPECTED_ANNUAL_GROWTH annual growth</div> <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>Cash flow from operations</caption> <tfoot class=\'KJEReportTFooter\'> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder" scope=\'row\'>Net from operations </th><td class="KJECellStrong">CASH_FLOW_FROM_OPERATIONS</td></tr> </tfoot> <tbody class=\'KJEReportTBody\'> <tr class=KJEOddRow><th class="KJELabel KJECellBorder KJECell60" scope=\'row\'>Operating profit</th><td class="KJECell KJECell40">OPERATING_PROFIT</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder" scope=\'row\'>Interest expense</th><td class="KJECell">INTEREST_EXPENSE</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder" scope=\'row\'>Interest income</th><td class="KJECell">INTEREST_INCOME</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder" scope=\'row\'>Income taxes</th><td class="KJECell">INCOME_TAXES</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder" scope=\'row\'>Depreciation and amortization</th><td class="KJECell">DEPRECIATION_AND_AMORTIZATION</td></tr> </tbody> </table></div> <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>Cash flow from change in operating assets & liabilities</caption> <tfoot class=\'KJEReportTFooter\'> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder" scope=\'row\'>Net from change in assets & liabilities </th><td class="KJECellStrong">CHANGES_IN_OPERATING_ASSETS_LIABILITIES</td></tr> </tfoot> <tbody class=\'KJEReportTBody\'> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder KJECell60" scope=\'row\'>Change in accounts payable</th><td class="KJECell KJECell40">CHANGE_IN_NOTES_PAYABLE</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder" scope=\'row\'>Change in inventory</th><td class="KJECell">CHANGE_IN_INVENTORY</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder" scope=\'row\'>Change in accounts receivable</th><td class="KJECell">CHANGE_IN_ACCOUNTS_RECEIVABLE</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder" scope=\'row\'>Other net change</th><td class="KJECell">OTHER_NET_CHANGE</td></tr> </tbody> </table></div> <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>Cash flow from investment activities</caption> <tfoot class=\'KJEReportTFooter\'> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder" scope=\'row\'>Net from investment activities </th><td class="KJECellStrong">CASH_FLOW_FROM_INVESTMENT_ACTVITIES</td></tr> </tfoot> <tbody class=\'KJEReportTBody\'> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder KJECell60" scope=\'row\'>Capital expenditures</th><td class="KJECell KJECell40">CAPITAL_EXPENDITURES</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder" scope=\'row\'>Additional investment income</th><td class="KJECell">OTHER_NET_AMOUNT</td></tr> </tbody> </table></div> ';