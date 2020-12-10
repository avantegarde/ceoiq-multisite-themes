KJE.ConsolidateCalc=function(){this.USE_BUSINESS=0;this.INPUT_YEARS=KJE.parameters.get("INPUT_YEARS",false);this.MSG_ERROR2=KJE.parameters.get("MSG_ERROR2","Please enter the number of months left for installment loan");this.MSG_ERROR3=KJE.parameters.get("MSG_ERROR3","Please enter the number of months left for the");this.MSG_ERROR4=KJE.parameters.get("MSG_ERROR4","Calculated remaining payments exceeds 480 months.");this.MSG_ERROR5=KJE.parameters.get("MSG_ERROR5","Installment loan");this.MSG_ERROR6=KJE.parameters.get("MSG_ERROR6","payment must be greater than");this.MSG_ERROR7=KJE.parameters.get("MSG_ERROR7","Other loan payment must be greater than");this.MSG_ERROR8=KJE.parameters.get("MSG_ERROR8","Total debt balances must be greater than zero.");this.MSG_ERROR9=KJE.parameters.get("MSG_ERROR9","Total monthly payments must be greater than zero.");this.MSG_TEXT1=KJE.parameters.get("MSG_TEXT1","Your monthly payment changes from KJE1 to KJE2.");this.MSG_TEXT3=KJE.parameters.get("MSG_TEXT3","By consolidating your loans you will save KJE1.");this.MSG_TEXT5=KJE.parameters.get("MSG_TEXT5","By consolidating your loans you will pay KJE1.");this.MSG_TEXT7=KJE.parameters.get("MSG_TEXT7","This includes NEW_LOAN_TAX_SAVINGS in income tax savings.");this.MSG_TEXT9=KJE.parameters.get("MSG_TEXT9","This also takes into account TOTAL_CLOSING_COSTS in closing costs plus the interest you would have earned had you put your closing costs into savings (after taxes).");this.MSG_TEXT11=KJE.parameters.get("MSG_TEXT11","Closing costs included in loan");this.MSG_TEXT12=KJE.parameters.get("MSG_TEXT12","Closing costs paid up front");this.BIZ_CALCULATOR=KJE.parameters.get("BIZ_CALCULATOR",false);this.DS_BALANCE=null;this.cats=null;this.sSchedule=new KJE.Repeating()};KJE.ConsolidateCalc.prototype.clear=function(){this.AUTO_LOAN_AMOUNT_OWED=0;this.AUTO_LOAN_PAYMENT=0;this.AUTO_LOAN_MONTHS_LEFT=0;this.AUTO_LOAN_2_AMOUNT_OWED=0;this.AUTO_LOAN_2_PAYMENT=0;this.AUTO_LOAN_2_MONTHS_LEFT=0;this.BOAT_RV_LOANS_AMOUNT_OWED=0;this.BOAT_RV_LOANS_PAYMENT=0;this.BOAT_RV_LOANS_MONTHS_LEFT=0;this.EDUCATION_LOANS_AMOUNT_OWED=0;this.EDUCATION_LOANS_PAYMENT=0;this.EDUCATION_LOANS_MONTHS_LEFT=0;this.OTHER_LOANS_AMOUNT_OWED=0;this.OTHER_LOANS_PAYMENT=0;this.OTHER_LOANS_MONTHS_LEFT=0;this.AUTO_LOAN_RATE=0;this.AUTO_LOAN_2_RATE=0;this.BOAT_RV_LOANS_RATE=0;this.EDUCATION_LOANS_RATE=0;this.OTHER_LOANS_RATE=0;this.CREDIT_CARD_1_AMOUNT=0;this.CREDIT_CARD_1_RATE=0;this.CREDIT_CARD_2_AMOUNT=0;this.CREDIT_CARD_2_RATE=0;this.CREDIT_CARD_3_AMOUNT=0;this.CREDIT_CARD_3_RATE=0;this.OTHER_ACCOUNT_AMOUNT=0;this.OTHER_ACCOUNT_RATE=0;this.INTEREST_RATE=0;this.TERM_IN_MONTHS=0;this.UP_FRONT_COSTS=0;this.POINTS=0;this.RATE_EARNED_ON_SAVINGS=0;this.INCOME_TAX_RATE=0;this.LOAN_TYPE=KJE.ConsolidateCalc.LOAN_TYPE_PERSONAL;this.INCLUDE_CLOSING_COSTS_IN_LOAN=false;this.TOTAL_CREDIT_CARD_DEBT=0;this.TOTAL_INSTALLMENT_LOAN_DEBT=0;this.TOTAL_CREDIT_CARD_PAYMENT=0;this.TOTAL_INSTALLMENT_LOAN_PAYMENT=0};KJE.ConsolidateCalc.prototype.calculate=function(ab){var g=KJE;var w=this.AUTO_LOAN_AMOUNT_OWED;var ac=this.AUTO_LOAN_PAYMENT;var v=this.AUTO_LOAN_MONTHS_LEFT;var ah=this.AUTO_LOAN_2_AMOUNT_OWED;var a=this.AUTO_LOAN_2_PAYMENT;var ag=this.AUTO_LOAN_2_MONTHS_LEFT;var am=this.BOAT_RV_LOANS_AMOUNT_OWED;var A=this.BOAT_RV_LOANS_PAYMENT;var ai=this.BOAT_RV_LOANS_MONTHS_LEFT;var F=this.EDUCATION_LOANS_AMOUNT_OWED;var an=this.EDUCATION_LOANS_PAYMENT;var D=this.EDUCATION_LOANS_MONTHS_LEFT;var k=this.OTHER_LOANS_AMOUNT_OWED;var aa=this.OTHER_LOANS_PAYMENT;var l=this.OTHER_LOANS_MONTHS_LEFT;var S=this.CREDIT_CARD_1_AMOUNT;var U=this.CREDIT_CARD_1_RATE;var W=this.CREDIT_CARD_2_AMOUNT;var y=this.CREDIT_CARD_2_RATE;var af=this.CREDIT_CARD_3_AMOUNT;var Z=this.CREDIT_CARD_3_RATE;var ak=this.OTHER_ACCOUNT_AMOUNT;var O=this.OTHER_ACCOUNT_RATE;var f=this.INTEREST_RATE;var P=this.TERM_IN_MONTHS;var c=this.UP_FRONT_COSTS;var B=this.POINTS;var V=this.RATE_EARNED_ON_SAVINGS;var Q=this.INCOME_TAX_RATE;var C=this.LOAN_TYPE;var d=this.INCLUDE_CLOSING_COSTS_IN_LOAN;var ao=0;var j=0;var J=0;var T=0;var o=0;var K=0;var t=0;var h="";if(this.INPUT_YEARS){P=P*12}if(ac>0||w>0){v=Math.ceil(KJE.PERIODS(this.AUTO_LOAN_RATE/1200,ac,w));if(v>480){throw (this.MSG_ERROR4)}}if(a>0||ah>0){ag=Math.ceil(KJE.PERIODS(this.AUTO_LOAN_2_RATE/1200,a,ah));if(ag>480){throw (this.MSG_ERROR4)}}if(A>0||am>0){ai=Math.ceil(KJE.PERIODS(this.BOAT_RV_LOANS_RATE/1200,A,am));if(ai>480){throw (this.MSG_ERROR4)}}if(an>0||F>0){D=Math.ceil(KJE.PERIODS(this.EDUCATION_LOANS_RATE/1200,an,F));if(D>480){throw (this.MSG_ERROR4)}}if(aa>0||k>0){l=Math.ceil(KJE.PERIODS(this.OTHER_LOANS_RATE/1200,aa,k));if(l>480){throw (this.MSG_ERROR4)}}if(S>0){T=KJE.PMT(U/1200,P,S)}if(W>0){o=KJE.PMT(y/1200,P,W)}if(af>0){K=KJE.PMT(Z/1200,P,af)}if(ak>0){t=KJE.PMT(O/1200,P,ak)}this.TOTAL_CREDIT_CARD_DEBT=S+W+af+ak;this.TOTAL_INSTALLMENT_LOAN_DEBT=w+ah+am+F+k;var ae=this.TOTAL_CREDIT_CARD_DEBT+this.TOTAL_INSTALLMENT_LOAN_DEBT;var G=T+o+K+t;var p=ac+a+A+an+aa;var u=G+p;var e=ae*B/100;var Y=e+c;if(d){J=ae+Y;j=0}else{J=ae;j=KJE.FV_AMT((V/1200)*(1-Q/100),P,Y)}this.CURRENT_LOANS_INITIAL_PAYMENT=u;var R=0;var N=T*P+o*P+K*P+t*P+ac*v+a*ag+A*ai+an*D+aa*l;var E=N-ae;var I=g.round(KJE.PMT(f/1200,P,J),2);var ap=I*P;var X=ap-J;if(C==KJE.ConsolidateCalc.LOAN_TYPE_HOME_EQUITY){ao=g.round(X*(Q/100),2)}else{ao=0}var H=ap-ao+j;var M=KJE.getKJEReplaced(this.MSG_TEXT1,g.dollars(u),g.dollars(I));if(H<N){h=KJE.getKJEReplaced(this.MSG_TEXT3,g.dollars(N-H))}else{h=KJE.getKJEReplaced(this.MSG_TEXT5,g.dollars(H-N))}if(C==KJE.ConsolidateCalc.LOAN_TYPE_HOME_EQUITY){h+=" "+this.MSG_TEXT7}if(!d&&j>0){h+=" "+this.MSG_TEXT9}var m=Math.round(P);var aj=0;if(m>120){var x=Math.floor(m/12)+(m%12==0?1:2);this.DS_BALANCE=KJE.FloatArray(x);this.cats=KJE.FloatArray(x)}else{this.DS_BALANCE=KJE.FloatArray(m);this.cats=KJE.FloatArray(m)}var q=0;var b=0;var r=J;if(ab){var L=this.sSchedule;L.clearRepeat();L.addHeader(L.sReportCol("Nbr",1),L.sReportCol("Amount",2),L.sReportCol("Interest",3),L.sReportCol("Principal",4),L.sReportCol("Balance",5));L.addRepeat("&nbsp;","&nbsp;","&nbsp;","&nbsp;",""+g.dollars(r)+"")}if(m>120){this.DS_BALANCE[0]=((r));this.cats[0]="0"}var z=0;var al=I;for(var ad=1;ad<=m;ad++){aj=ad-1;if(m>120){this.DS_BALANCE[(aj/12)+1]=((r));this.cats[(aj/12)+1]=""+((aj/12)+1)}else{this.DS_BALANCE[aj]=((r));this.cats[aj]=""+ad}z=r;q=g.round((f/(1200))*r,2);b=I-q;r-=b;al=I;if(r<0){al+=r;r=0;b=al-q}if(m==ad){if(r>0.005){al+=r;r=0;b=al-q}else{r=0}}if(ab){L.addRepeat(ad,g.dollars(al,2),g.dollars(q,2),g.dollars(b,2),g.dollars(r,2))}}this.AUTO_LOAN_MONTHS_LEFT=v;this.AUTO_LOAN_2_MONTHS_LEFT=ag;this.BOAT_RV_LOANS_MONTHS_LEFT=ai;this.EDUCATION_LOANS_MONTHS_LEFT=D;this.RESULTS_MESSAGE=M;this.CURRENT_LOANS_TOTAL_INTEREST=E;this.CURRENT_LOANS_TAX_SAVINGS=R;this.CURRENT_LOANS_TOTAL_PAYMENTS=N;this.CURRENT_LOANS_MONTHLY_PAYMENTS=u;this.NEW_LOAN_INITIAL_PAYMENT=I;this.NEW_LOAN_TOTAL_INTEREST=X;this.NEW_LOAN_TAX_SAVINGS=ao;this.NEW_LOAN_TOTAL_PAYMENTS=ap;this.INTEREST_FROM_SAVINGS_ACCOUNT=j;this.COST_OF_POINTS=e;this.TOTAL_CLOSING_COSTS=Y;this.NEW_LOAN_AMOUNT=J;this.CREDIT_CARD_1_PAYMENT=T;this.CREDIT_CARD_2_PAYMENT=o;this.CREDIT_CARD_3_PAYMENT=K;this.OTHER_ACCOUNT_PAYMENT=t;this.CURRENT_LOANS_BALANCE=ae;this.SAVINGS_MESSAGE=h;this.NEW_LOAN_NET_PAYMENTS=H};KJE.ConsolidateCalc.prototype.formatReport=function(b){var c=KJE;var a=this.iDecimal;var d=b;d=KJE.replace("SAVINGS_MESSAGE",this.SAVINGS_MESSAGE,d);if(this.INCLUDE_CLOSING_COSTS_IN_LOAN){d=KJE.replace("INCLUDE_CLOSING_COSTS_IN_LOAN",this.MSG_TEXT11,d)}else{d=KJE.replace("INCLUDE_CLOSING_COSTS_IN_LOAN",this.MSG_TEXT12,d)}d=KJE.replace("TOTAL_CREDIT_CARD_DEBT",c.dollars(this.TOTAL_CREDIT_CARD_DEBT),d);d=KJE.replace("TOTAL_INSTALLMENT_LOAN_DEBT",c.dollars(this.TOTAL_INSTALLMENT_LOAN_DEBT),d);d=KJE.replace("TOTAL_CREDIT_CARD_PAYMENT",c.dollars(this.TOTAL_CREDIT_CARD_PAYMENT),d);d=KJE.replace("TOTAL_INSTALLMENT_LOAN_PAYMENT",c.dollars(this.TOTAL_INSTALLMENT_LOAN_PAYMENT),d);d=KJE.replace("AUTO_LOAN_AMOUNT_OWED",c.dollars(this.AUTO_LOAN_AMOUNT_OWED),d);d=KJE.replace("AUTO_LOAN_PAYMENT",c.dollars(this.AUTO_LOAN_PAYMENT),d);d=KJE.replace("AUTO_LOAN_MONTHS_LEFT",c.number(this.AUTO_LOAN_MONTHS_LEFT),d);d=KJE.replace("AUTO_LOAN_2_AMOUNT_OWED",c.dollars(this.AUTO_LOAN_2_AMOUNT_OWED),d);d=KJE.replace("AUTO_LOAN_2_PAYMENT",c.dollars(this.AUTO_LOAN_2_PAYMENT),d);d=KJE.replace("AUTO_LOAN_2_MONTHS_LEFT",c.number(this.AUTO_LOAN_2_MONTHS_LEFT),d);d=KJE.replace("BOAT_RV_LOANS_AMOUNT_OWED",c.dollars(this.BOAT_RV_LOANS_AMOUNT_OWED),d);d=KJE.replace("BOAT_RV_LOANS_PAYMENT",c.dollars(this.BOAT_RV_LOANS_PAYMENT),d);d=KJE.replace("BOAT_RV_LOANS_MONTHS_LEFT",c.number(this.BOAT_RV_LOANS_MONTHS_LEFT),d);d=KJE.replace("EDUCATION_LOANS_AMOUNT_OWED",c.dollars(this.EDUCATION_LOANS_AMOUNT_OWED),d);d=KJE.replace("EDUCATION_LOANS_PAYMENT",c.dollars(this.EDUCATION_LOANS_PAYMENT),d);d=KJE.replace("EDUCATION_LOANS_MONTHS_LEFT",c.number(this.EDUCATION_LOANS_MONTHS_LEFT),d);d=KJE.replace("OTHER_LOANS_AMOUNT_OWED",c.dollars(this.OTHER_LOANS_AMOUNT_OWED),d);d=KJE.replace("OTHER_LOANS_PAYMENT",c.dollars(this.OTHER_LOANS_PAYMENT),d);d=KJE.replace("OTHER_LOANS_MONTHS_LEFT",c.number(this.OTHER_LOANS_MONTHS_LEFT),d);d=KJE.replace("CREDIT_CARD_1_AMOUNT",c.dollars(this.CREDIT_CARD_1_AMOUNT),d);d=KJE.replace("CREDIT_CARD_1_RATE",c.percent(this.CREDIT_CARD_1_RATE/100,2),d);d=KJE.replace("CREDIT_CARD_2_AMOUNT",c.dollars(this.CREDIT_CARD_2_AMOUNT),d);d=KJE.replace("CREDIT_CARD_2_RATE",c.percent(this.CREDIT_CARD_2_RATE/100,2),d);d=KJE.replace("CREDIT_CARD_3_AMOUNT",c.dollars(this.CREDIT_CARD_3_AMOUNT),d);d=KJE.replace("CREDIT_CARD_3_RATE",c.percent(this.CREDIT_CARD_3_RATE/100,2),d);d=KJE.replace("OTHER_ACCOUNT_AMOUNT",c.dollars(this.OTHER_ACCOUNT_AMOUNT),d);d=KJE.replace("OTHER_ACCOUNT_RATE",c.percent(this.OTHER_ACCOUNT_RATE/100,2),d);d=KJE.replace("INTEREST_RATE",c.percent(this.INTEREST_RATE/100,2),d);d=KJE.replace("TERM_IN_MONTHS",c.number(this.TERM_IN_MONTHS),d);d=KJE.replace("UP_FRONT_COSTS",c.dollars(this.UP_FRONT_COSTS),d);d=KJE.replace("RATE_EARNED_ON_SAVINGS",c.percent(this.RATE_EARNED_ON_SAVINGS/100,2),d);d=KJE.replace("INCOME_TAX_RATE",c.percent(this.INCOME_TAX_RATE/100,2),d);d=KJE.replace("LOAN_TYPE",KJE.ConsolidateCalc.LOAN_TYPE_DESC[this.LOAN_TYPE],d);d=KJE.replace("RESULTS_MESSAGE",this.RESULTS_MESSAGE,d);d=KJE.replace("CURRENT_LOANS_INITIAL_PAYMENT",c.dollars(this.CURRENT_LOANS_INITIAL_PAYMENT),d);d=KJE.replace("CURRENT_LOANS_TOTAL_INTEREST",c.dollars(this.CURRENT_LOANS_TOTAL_INTEREST),d);d=KJE.replace("CURRENT_LOANS_TAX_SAVINGS",c.dollars(this.CURRENT_LOANS_TAX_SAVINGS),d);d=KJE.replace("CURRENT_LOANS_TOTAL_PAYMENTS",c.dollars(this.CURRENT_LOANS_TOTAL_PAYMENTS),d);d=KJE.replace("NEW_LOAN_INITIAL_PAYMENT",c.dollars(this.NEW_LOAN_INITIAL_PAYMENT),d);d=KJE.replace("NEW_LOAN_TOTAL_INTEREST",c.dollars(this.NEW_LOAN_TOTAL_INTEREST),d);d=KJE.replace("NEW_LOAN_TAX_SAVINGS",c.dollars(this.NEW_LOAN_TAX_SAVINGS),d);d=KJE.replace("NEW_LOAN_TOTAL_PAYMENTS",c.dollars(this.NEW_LOAN_TOTAL_PAYMENTS),d);d=KJE.replace("INTEREST_FROM_SAVINGS_ACCOUNT",c.dollars(this.INTEREST_FROM_SAVINGS_ACCOUNT),d);d=KJE.replace("COST_OF_POINTS",c.dollars(this.COST_OF_POINTS),d);d=KJE.replace("TOTAL_CLOSING_COSTS",c.dollars(this.TOTAL_CLOSING_COSTS),d);d=KJE.replace("NEW_LOAN_AMOUNT",c.dollars(this.NEW_LOAN_AMOUNT),d);d=KJE.replace("INCLUDE_CLOSING_COSTS_IN_LOAN",c.dollars(this.INCLUDE_CLOSING_COSTS_IN_LOAN),d);d=KJE.replace("CREDIT_CARD_1_PAYMENT",c.dollars(this.CREDIT_CARD_1_PAYMENT),d);d=KJE.replace("CREDIT_CARD_2_PAYMENT",c.dollars(this.CREDIT_CARD_2_PAYMENT),d);d=KJE.replace("CREDIT_CARD_3_PAYMENT",c.dollars(this.CREDIT_CARD_3_PAYMENT),d);d=KJE.replace("OTHER_ACCOUNT_PAYMENT",c.dollars(this.OTHER_ACCOUNT_PAYMENT),d);d=KJE.replace("CURRENT_LOANS_MONTHLY_PAYMENTS",c.dollars(this.CURRENT_LOANS_MONTHLY_PAYMENTS),d);d=KJE.replace("CURRENT_LOANS_BALANCE",c.dollars(this.CURRENT_LOANS_BALANCE),d);d=KJE.replace("POINTS",c.number(this.POINTS,2),d);d=KJE.replace("NEW_LOAN_NET_PAYMENTS",c.dollars(this.NEW_LOAN_NET_PAYMENTS),d);d=d.replace("**REPEATING GROUP**",this.sSchedule.getRepeat());this.sSchedule.clearRepeat();return d};KJE.ConsolidateCalc.LOAN_TYPE_PERSONAL=0;KJE.ConsolidateCalc.LOAN_TYPE_HOME_EQUITY=1;KJE.ConsolidateCalc.LOAN_TYPE_ID=[KJE.ConsolidateCalc.LOAN_TYPE_PERSONAL,KJE.ConsolidateCalc.LOAN_TYPE_HOME_EQUITY];KJE.ConsolidateCalc.LOAN_TYPE_DESC=KJE.parameters.get("ARRAY_LOAN_TYPE",["Personal","Home equity"]);KJE.CalcName="Business Debt Consolidation Calculator";KJE.CalcType="BizConsolidate";KJE.CalculatorTitleTemplate="KJE1";KJE.parseInputs=function(b){var a=KJE.getDropBox("LOAN_TYPE",KJE.parameters.get("LOAN_TYPE",KJE.ConsolidateCalc.LOAN_TYPE_PERSONAL),KJE.ConsolidateCalc.LOAN_TYPE_ID,KJE.ConsolidateCalc.LOAN_TYPE_DESC);b=KJE.replace("**LOAN_TYPE**",a,b);return b};KJE.initialize=function(){KJE.CalcControl=new KJE.ConsolidateCalc();KJE.GuiControl=new KJE.Consolidate(KJE.CalcControl)};KJE.Consolidate=function(j){var f=KJE;var b=KJE.gLegend;var g=KJE.inputs.items;this.MSG_TEXT23=KJE.parameters.get("MSG_TEXT23","Year");this.MSG_TEXT24=KJE.parameters.get("MSG_TEXT24","Payment");this.MSG_TEXT21=KJE.parameters.get("MSG_TEXT21","Loan balance");KJE.InputItem.AltHelpName="LOAN_AMOUNT_OWED";KJE.DollarSlider("AUTO_LOAN_AMOUNT_OWED",KJE.parameters.get("MSG_LOAN_AMOUNT",(j.BIZ_CALCULATOR?"Installment loan #1":"Auto loan #1")+" balance"),0,250000,0,0,2,"bold");KJE.DollarSlider("AUTO_LOAN_2_AMOUNT_OWED",KJE.parameters.get("MSG_LOAN_AMOUNT",(j.BIZ_CALCULATOR?"Installment loan #2":"Auto loan #2")+" balance"),0,250000,0,0,2,"bold");KJE.DollarSlider("BOAT_RV_LOANS_AMOUNT_OWED",KJE.parameters.get("MSG_LOAN_AMOUNT",(j.BIZ_CALCULATOR?"Installment loan #3":"Boat RV loans")+" balance"),0,250000,0,0,2,"bold");KJE.DollarSlider("EDUCATION_LOANS_AMOUNT_OWED",KJE.parameters.get("MSG_LOAN_AMOUNT",(j.BIZ_CALCULATOR?"Installment loan #4":"Education loans")+" balance"),0,250000,0,0,2,"bold");KJE.DollarSlider("OTHER_LOANS_AMOUNT_OWED",KJE.parameters.get("MSG_LOAN_AMOUNT","Other loan balance"),0,250000,0,0,2,"bold");s=KJE.parameters.get("MSG_PAYMENT","Payment");KJE.InputItem.AltHelpName="LOAN_PAYMENT";KJE.DollarSlider("AUTO_LOAN_PAYMENT",s,0,100000,0,0,1);KJE.DollarSlider("AUTO_LOAN_2_PAYMENT",s,0,100000,0,0,1);KJE.DollarSlider("BOAT_RV_LOANS_PAYMENT",KJE.parameters.get("MSG_PAYMENT","Payment"),0,100000,0,0,1);KJE.DollarSlider("EDUCATION_LOANS_PAYMENT",s,0,100000,0,0,1);KJE.DollarSlider("OTHER_LOANS_PAYMENT",s,0,100000,0,0,1);s=KJE.parameters.get("MSG_MONTH_LEFT","Remaining payments");KJE.InputItem.AltHelpName="LOAN_MONTHS_LEFT";KJE.Label("AUTO_LOAN_MONTHS_LEFT",s);KJE.Label("AUTO_LOAN_2_MONTHS_LEFT",s);KJE.Label("BOAT_RV_LOANS_MONTHS_LEFT",s);KJE.Label("EDUCATION_LOANS_MONTHS_LEFT",s);KJE.Label("OTHER_LOANS_MONTHS_LEFT",s);s=KJE.parameters.get("MSG_INTEREST_RATE","Interest rate");KJE.InputItem.AltHelpName="LOAN_RATE";KJE.PercentSlider("AUTO_LOAN_RATE",s,0,30,2);KJE.PercentSlider("AUTO_LOAN_2_RATE",s,0,30,2);KJE.PercentSlider("BOAT_RV_LOANS_RATE",s,0,30,2);KJE.PercentSlider("EDUCATION_LOANS_RATE",s,0,30,2);KJE.PercentSlider("OTHER_LOANS_RATE",s,0,30,2);KJE.InputItem.AltHelpName="CC_BALANCE";KJE.DollarSlider("CREDIT_CARD_1_AMOUNT",KJE.parameters.get("MSG_CARD_AMOUNT",(j.BIZ_CALCULATOR?"Card / Line #1 balance":"Credit card #1 balance")),0,250000,0,0,2,"bold");KJE.DollarSlider("CREDIT_CARD_2_AMOUNT",KJE.parameters.get("MSG_CARD_AMOUNT",(j.BIZ_CALCULATOR?"Card / Line #2 balance":"Credit card #2 balance")),0,250000,0,0,2,"bold");KJE.DollarSlider("CREDIT_CARD_3_AMOUNT",KJE.parameters.get("MSG_CARD_AMOUNT",(j.BIZ_CALCULATOR?"Card / Line #3 balance":"Credit card #3 balance")),0,250000,0,0,2,"bold");KJE.DollarSlider("OTHER_ACCOUNT_AMOUNT",KJE.parameters.get("MSG_CARD_AMOUNT","Other account balance"),0,250000,0,0,2,"bold");KJE.InputItem.AltHelpName="CC_RATE";KJE.PercentSlider("CREDIT_CARD_1_RATE",s,0,30,2);KJE.PercentSlider("CREDIT_CARD_2_RATE",s,0,30,2);KJE.PercentSlider("CREDIT_CARD_3_RATE",s,0,30,2);KJE.PercentSlider("OTHER_ACCOUNT_RATE",s,0,30,2);KJE.InputItem.AltHelpName="CC_PAYMENT";KJE.Label("CREDIT_CARD_1_PAYMENT",KJE.parameters.get("MSG_CARD_PAYMENT","Payment"));KJE.Label("CREDIT_CARD_2_PAYMENT",KJE.parameters.get("MSG_CARD_PAYMENT","Payment"));KJE.Label("CREDIT_CARD_3_PAYMENT",KJE.parameters.get("MSG_CARD_PAYMENT","Payment"));KJE.Label("OTHER_ACCOUNT_PAYMENT",KJE.parameters.get("MSG_CARD_PAYMENT","Payment"));KJE.InputItem.AltHelpName=null;KJE.PercentSlider("INTEREST_RATE","Interest rate",0,30,2);if(j.INPUT_YEARS){KJE.NumberSlider("TERM_IN_MONTHS","Term in years",1,30,0);g.TERM_IN_MONTHS.setValue(Math.round(KJE.parameters.get("TERM_IN_MONTHS",60)/12),true)}else{KJE.NumberSlider("TERM_IN_MONTHS","Term in months",12,360,0)}KJE.DollarSlider("UP_FRONT_COSTS","Up front costs",0,10000);KJE.NumberSlider("POINTS","Points",0,6,2);KJE.InvestRateSlider("RATE_EARNED_ON_SAVINGS","Savings rate");KJE.PercentSlider("INCOME_TAX_RATE","Income tax rate",0,50,2);KJE.Checkbox("INCLUDE_CLOSING_COSTS_IN_LOAN","Closing costs",false,"Check here to include closing costs in loan");KJE.DropBoxString("LOAN_TYPE","Loan type");var h=KJE.gNewGraph(KJE.gLINE,"GRAPH1",true,false,KJE.colorList[1],KJE.parameters.get("MSG_GRAPH_TITLE","Consolidated Loan Balance by KJE1"));h._legend._iOrientation=(b.BOTTOM);h._legend.setVisible(false);h._iArea=KJE.gGraphLine.AREA_FIRST_ONLY;if(j.BIZ_CALCULATOR){g.POINTS.hide();g.INCOME_TAX_RATE.hide();g.LOAN_TYPE.hide()}var n=KJE.parameters.get("MSG_WINDOW_TITLE2",(j.BIZ_CALCULATOR?"Total credit card & line debt ":"Total credit card debt "))+KJE.Colon+" ";var k=KJE.parameters.get("MSG_CC_CLOSETITLE","KJE1");var e=function(){return n+"|"+KJE.subText(KJE.getKJEReplaced(k,f.dollars(j.TOTAL_CREDIT_CARD_DEBT)),"KJERightBold")};KJE.addDropper(new KJE.Dropper("CC",false,e,e),KJE.colorList[0]);var o=KJE.parameters.get("MSG_WINDOW_TITLE1","Installment Loans")+KJE.Colon+" ";var d=KJE.parameters.get("MSG_LOANS_CLOSETITLE","KJE1");var m=function(){return o+"|"+KJE.subText(KJE.getKJEReplaced(d,f.dollars(j.TOTAL_INSTALLMENT_LOAN_DEBT)),"KJERightBold")};KJE.addDropper(new KJE.Dropper("LOANS",false,m,m),KJE.colorList[0]);var c=KJE.parameters.get("MSG_NEW_LOAN_TITLE","Consolidated loan:");var i=KJE.parameters.get("MSG_NEW_LOAN_CLOSETITLE","Loan amount KJE1");var a=function(){return c+"|"+KJE.subText(KJE.getKJEReplaced(i,f.dollars(j.NEW_LOAN_AMOUNT)),"KJERightBold")};KJE.addDropper(new KJE.Dropper("NEW_LOAN",true,a,a),KJE.colorList[0])};KJE.Consolidate.prototype.setValues=function(b){var a=KJE.inputs.items;b.AUTO_LOAN_AMOUNT_OWED=a.AUTO_LOAN_AMOUNT_OWED.getValue();b.AUTO_LOAN_PAYMENT=a.AUTO_LOAN_PAYMENT.getValue();b.AUTO_LOAN_RATE=a.AUTO_LOAN_RATE.getValue();b.AUTO_LOAN_2_AMOUNT_OWED=a.AUTO_LOAN_2_AMOUNT_OWED.getValue();b.AUTO_LOAN_2_PAYMENT=a.AUTO_LOAN_2_PAYMENT.getValue();b.AUTO_LOAN_2_RATE=a.AUTO_LOAN_2_RATE.getValue();b.BOAT_RV_LOANS_AMOUNT_OWED=a.BOAT_RV_LOANS_AMOUNT_OWED.getValue();b.BOAT_RV_LOANS_PAYMENT=a.BOAT_RV_LOANS_PAYMENT.getValue();b.BOAT_RV_LOANS_RATE=a.BOAT_RV_LOANS_RATE.getValue();b.EDUCATION_LOANS_AMOUNT_OWED=a.EDUCATION_LOANS_AMOUNT_OWED.getValue();b.EDUCATION_LOANS_PAYMENT=a.EDUCATION_LOANS_PAYMENT.getValue();b.EDUCATION_LOANS_RATE=a.EDUCATION_LOANS_RATE.getValue();b.OTHER_LOANS_AMOUNT_OWED=a.OTHER_LOANS_AMOUNT_OWED.getValue();b.OTHER_LOANS_PAYMENT=a.OTHER_LOANS_PAYMENT.getValue();b.OTHER_LOANS_RATE=a.OTHER_LOANS_RATE.getValue();b.CREDIT_CARD_1_AMOUNT=a.CREDIT_CARD_1_AMOUNT.getValue();b.CREDIT_CARD_1_RATE=a.CREDIT_CARD_1_RATE.getValue();b.CREDIT_CARD_2_AMOUNT=a.CREDIT_CARD_2_AMOUNT.getValue();b.CREDIT_CARD_2_RATE=a.CREDIT_CARD_2_RATE.getValue();b.CREDIT_CARD_3_AMOUNT=a.CREDIT_CARD_3_AMOUNT.getValue();b.CREDIT_CARD_3_RATE=a.CREDIT_CARD_3_RATE.getValue();b.OTHER_ACCOUNT_AMOUNT=a.OTHER_ACCOUNT_AMOUNT.getValue();b.OTHER_ACCOUNT_RATE=a.OTHER_ACCOUNT_RATE.getValue();b.INTEREST_RATE=a.INTEREST_RATE.getValue();b.TERM_IN_MONTHS=a.TERM_IN_MONTHS.getValue();b.UP_FRONT_COSTS=a.UP_FRONT_COSTS.getValue();b.POINTS=a.POINTS.getValue();b.RATE_EARNED_ON_SAVINGS=a.RATE_EARNED_ON_SAVINGS.getValue();b.INCOME_TAX_RATE=a.INCOME_TAX_RATE.getValue();b.LOAN_TYPE=a.LOAN_TYPE.getValue();b.INCLUDE_CLOSING_COSTS_IN_LOAN=a.INCLUDE_CLOSING_COSTS_IN_LOAN.getValue()};KJE.Consolidate.prototype.refresh=function(d){var b=KJE.inputs.items;var a=KJE.gGraphs[0];KJE.setTitleTemplate(d.RESULTS_MESSAGE);var c=d.TERM_IN_MONTHS>120?this.MSG_TEXT23:this.MSG_TEXT24;a.removeAll();a.setGraphCategories(d.cats);a.add(new KJE.gGraphDataSeries(d.DS_BALANCE,this.MSG_TEXT21+" "+c,a.getColor(1)));a.setTitleTemplate(c);a.paint();b.CREDIT_CARD_1_PAYMENT.setText(KJE.dollars(d.CREDIT_CARD_1_PAYMENT));b.CREDIT_CARD_2_PAYMENT.setText(KJE.dollars(d.CREDIT_CARD_2_PAYMENT));b.CREDIT_CARD_3_PAYMENT.setText(KJE.dollars(d.CREDIT_CARD_3_PAYMENT));b.AUTO_LOAN_MONTHS_LEFT.setText(KJE.number(d.AUTO_LOAN_MONTHS_LEFT),true);b.AUTO_LOAN_2_MONTHS_LEFT.setText(KJE.number(d.AUTO_LOAN_2_MONTHS_LEFT),true);b.BOAT_RV_LOANS_MONTHS_LEFT.setText(KJE.number(d.BOAT_RV_LOANS_MONTHS_LEFT),true);b.EDUCATION_LOANS_MONTHS_LEFT.setText(KJE.number(d.EDUCATION_LOANS_MONTHS_LEFT),true);b.OTHER_LOANS_MONTHS_LEFT.setText(KJE.number(d.OTHER_LOANS_MONTHS_LEFT),true)};KJE.InputScreenText=" <div id=KJE-D-CC><div id=KJE-P-CC>Input information:</div></div> <div id=KJE-E-CC > <div id='KJE-C-CREDIT_CARD_1_AMOUNT'><input id='KJE-CREDIT_CARD_1_AMOUNT' /></div> <div id='KJE-C-CREDIT_CARD_1_RATE'><input id='KJE-CREDIT_CARD_1_RATE' /></div> <div id='KJE-C-CREDIT_CARD_1_PAYMENT'><div id='KJE-CREDIT_CARD_1_PAYMENT'></div></div> <hr class=KJEDivide /> <div id='KJE-C-CREDIT_CARD_2_AMOUNT'><input id='KJE-CREDIT_CARD_2_AMOUNT' /></div> <div id='KJE-C-CREDIT_CARD_2_RATE'><input id='KJE-CREDIT_CARD_2_RATE' /></div> <div id='KJE-C-CREDIT_CARD_2_PAYMENT'><div id='KJE-CREDIT_CARD_2_PAYMENT'></div></div> <hr class=KJEDivide /> <div id='KJE-C-CREDIT_CARD_3_AMOUNT'><input id='KJE-CREDIT_CARD_3_AMOUNT' /></div> <div id='KJE-C-CREDIT_CARD_3_RATE'><input id='KJE-CREDIT_CARD_3_RATE' /></div> <div id='KJE-C-CREDIT_CARD_3_PAYMENT'><div id='KJE-CREDIT_CARD_3_PAYMENT'></div></div> <hr class=KJEDivide /> <div id='KJE-C-OTHER_ACCOUNT_AMOUNT'><input id='KJE-OTHER_ACCOUNT_AMOUNT' /></div> <div id='KJE-C-OTHER_ACCOUNT_RATE'><input id='KJE-OTHER_ACCOUNT_RATE' /></div> <div id='KJE-C-OTHER_ACCOUNT_PAYMENT'><div id='KJE-OTHER_ACCOUNT_PAYMENT'></div></div> </div> <div id=KJE-D-LOANS><div id=KJE-P-LOANS>Input information:</div></div> <div id=KJE-E-LOANS > <div id='KJE-C-AUTO_LOAN_AMOUNT_OWED'><input id='KJE-AUTO_LOAN_AMOUNT_OWED' /></div> <div id='KJE-C-AUTO_LOAN_RATE'><input id='KJE-AUTO_LOAN_RATE' /></div> <div id='KJE-C-AUTO_LOAN_PAYMENT'><input id='KJE-AUTO_LOAN_PAYMENT' /></div> <div id='KJE-C-AUTO_LOAN_MONTHS_LEFT'><div id='KJE-AUTO_LOAN_MONTHS_LEFT'></div></div> <hr class=KJEDivide /> <div id='KJE-C-AUTO_LOAN_2_AMOUNT_OWED'><input id='KJE-AUTO_LOAN_2_AMOUNT_OWED' /></div> <div id='KJE-C-AUTO_LOAN_2_RATE'><input id='KJE-AUTO_LOAN_2_RATE' /></div> <div id='KJE-C-AUTO_LOAN_2_PAYMENT'><input id='KJE-AUTO_LOAN_2_PAYMENT' /></div> <div id='KJE-C-AUTO_LOAN_2_MONTHS_LEFT'><div id='KJE-AUTO_LOAN_2_MONTHS_LEFT'></div></div> <hr class=KJEDivide /> <div id='KJE-C-BOAT_RV_LOANS_AMOUNT_OWED'><input id='KJE-BOAT_RV_LOANS_AMOUNT_OWED' /></div> <div id='KJE-C-BOAT_RV_LOANS_RATE'><input id='KJE-BOAT_RV_LOANS_RATE' /></div> <div id='KJE-C-BOAT_RV_LOANS_PAYMENT'><input id='KJE-BOAT_RV_LOANS_PAYMENT' /></div> <div id='KJE-C-BOAT_RV_LOANS_MONTHS_LEFT'><div id='KJE-BOAT_RV_LOANS_MONTHS_LEFT'></div></div> <hr class=KJEDivide /> <div id='KJE-C-EDUCATION_LOANS_AMOUNT_OWED'><input id='KJE-EDUCATION_LOANS_AMOUNT_OWED' /></div> <div id='KJE-C-EDUCATION_LOANS_RATE'><input id='KJE-EDUCATION_LOANS_RATE' /></div> <div id='KJE-C-EDUCATION_LOANS_PAYMENT'><input id='KJE-EDUCATION_LOANS_PAYMENT' /></div> <div id='KJE-C-EDUCATION_LOANS_MONTHS_LEFT'><div id='KJE-EDUCATION_LOANS_MONTHS_LEFT'></div></div> <hr class=KJEDivide /> <div id='KJE-C-OTHER_LOANS_AMOUNT_OWED'><input id='KJE-OTHER_LOANS_AMOUNT_OWED' /></div> <div id='KJE-C-OTHER_LOANS_RATE'><input id='KJE-OTHER_LOANS_RATE' /></div> <div id='KJE-C-OTHER_LOANS_PAYMENT'><input id='KJE-OTHER_LOANS_PAYMENT' /></div> <div id='KJE-C-OTHER_LOANS_MONTHS_LEFT'><div id='KJE-OTHER_LOANS_MONTHS_LEFT'></div></div> <div style=\"height:10px\"></div> </div> <div id=KJE-D-NEW_LOAN><div id=KJE-P-NEW_LOAN>Input information:</div></div> <div id=KJE-E-NEW_LOAN > <div id='KJE-C-INTEREST_RATE'><input id='KJE-INTEREST_RATE' /></div> <div id='KJE-C-TERM_IN_MONTHS'><input id='KJE-TERM_IN_MONTHS' /></div> <div id='KJE-C-UP_FRONT_COSTS'><input id='KJE-UP_FRONT_COSTS' /></div> <div id='KJE-C-RATE_EARNED_ON_SAVINGS'><input id='KJE-RATE_EARNED_ON_SAVINGS' /></div> <div id='KJE-C-POINTS'><input id='KJE-POINTS' /></div> <div id='KJE-C-INCOME_TAX_RATE'><input id='KJE-INCOME_TAX_RATE' /></div> <div id='KJE-C-LOAN_TYPE'>**LOAN_TYPE**</div> <div id='KJE-C-INCLUDE_CLOSING_COSTS_IN_LOAN'><input id='KJE-INCLUDE_CLOSING_COSTS_IN_LOAN' type=checkbox name='INCLUDE_CLOSING_COSTS_IN_LOAN' /></div> <div style=\"height:10px\"></div> </div> **GRAPH1** ";KJE.DefinitionText=" <div id='KJE-D-LOAN_AMOUNT_OWED' ><dt>Loan balance</dt><dd>Loan balance is the total remaining balance on a loan. If you are uncertain of your exact balance, enter an estimate that is as close as possible.</dd></div> <div id='KJE-D-LOAN_PAYMENT' ><dt>Loan payment</dt><dd>The payment amount is your current monthly payment.</dd></div> <div id='KJE-D-LOAN_MONTHS_LEFT' ><dt>Remaining payments</dt><dd>The number of months you have left to make payments on a loan. This is calculated from the interest rate, monthly payment and current balance of the loan.</dd></div> <div id='KJE-D-LOAN_RATE' ><dt>Loan interest rate</dt><dd>Annual interest rate for this loan. Interest is calculated monthly on the current outstanding balance of your loan at 1/12 of the annual rate.</dd></div> <div id='KJE-D-CC_BALANCE' ><dt>Credit card / credit line balance</dt><dd>The outstanding balance on your credit card. You do not need to include finance charges; they will be calculated based on your interest rate.</dd></div> <div id='KJE-D-CC_RATE' ><dt>Credit card / credit line rate</dt><dd>Annual interest rate you pay on outstanding credit card balances. This calculator assumes simple interest is charged every month at 1/12th of your annual rate.</dd></div> <div id='KJE-D-CC_PAYMENT' ><dt>Credit card payment</dt><dd>Credit card payments are based on your outstanding balance and annual interest rate. For this loan comparison, the monthly payment is the amount required to pay off your credit card in the same number of months as your consolidation loan. Your actual credit card payment may be lower, but will often require many more payments.</dd></div> <div id='KJE-D-INTEREST_RATE' ><dt>Interest rate</dt><dd>Annual interest rate for your new consolidation loan.</dd></div> <div id='KJE-D-TERM_IN_MONTHS' ><dt>Term in months</dt><dd>Number of months for your new consolidation loan.</dd></div> <div id='KJE-D-UP_FRONT_COSTS' ><dt>Up front costs</dt><dd>Any fees you are required to pay up front to receive this loan.</dd></div> <div id='KJE-D-RATE_EARNED_ON_SAVINGS' ><dt>Rate earned on savings</dt><dd>This is the rate of return you would expect to make on your closing costs, if you were to invest them. This could include appraisal fees, loan origination fees, etc.<p>**ROR_DEFINITION**</dd></div> <div id='KJE-D-INCLUDE_CLOSING_COSTS_IN_LOAN' ><dt>Include closing costs in loan</dt><dd>If you include your closing costs in your loan, your loan balance, monthly payment and total interest paid will increase. You will, however, be required to pay less money up front. Including your closing costs in your loan may be a good option if you do not have funds available, or you can achieve a relatively high rate of return on your savings.</dd></div> ";KJE.ReportText=' <!--HEADING "Business Debt Consolidation" HEADING--> <h2 class=\'KJEReportHeader KJEFontHeading\'>RESULTS_MESSAGE</h2> RESULTS_MESSAGE SAVINGS_MESSAGE **GRAPH** <div class=KJEReportTableDiv><table class=KJEReportTable> <tr class=KJEHeaderRow><th class=KJEHeading>&nbsp;</th><th class=KJEHeading>Current loans</th><th class=KJEHeading>Consolidated Loan</th></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder KJECell60">Balance </th><td class="KJECell KJECellBorder KJECell20">CURRENT_LOANS_BALANCE</td><td class="KJECell KJECell20">NEW_LOAN_AMOUNT</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Total interest </th><td class="KJECell KJECellBorder">CURRENT_LOANS_TOTAL_INTEREST </td><td class="KJECell">NEW_LOAN_TOTAL_INTEREST </td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Closing costs + lost interest*</th><td class="KJECell KJECellBorder">$0</td><td class="KJECell">INTEREST_FROM_SAVINGS_ACCOUNT</td></tr> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder">Total payments </th><td class="KJECellStrong KJECellBorder">CURRENT_LOANS_TOTAL_PAYMENTS</td><td class="KJECellStrong">NEW_LOAN_NET_PAYMENTS</td></tr></table> </div> <div class=KJEInset>*This amount is $0 if closing costs are included in the loan amount.</div> <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>New Consolidation Loan</caption> <tr class=KJEOddRow><th class="KJELabel KJECellBorder KJECell60">Loan amount </th><td class="KJECell KJECell40">NEW_LOAN_AMOUNT </td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Monthly payment </th><td class="KJECell">NEW_LOAN_INITIAL_PAYMENT </td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Interest rate </th><td class="KJECell">INTEREST_RATE </td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Term in months </th><td class="KJECell">TERM_IN_MONTHS </td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Total closing costs </th><td class="KJECell">TOTAL_CLOSING_COSTS INCLUDE_CLOSING_COSTS_IN_LOAN</td></tr></table> </div> <h2 class=\'KJEReportHeader KJEFontHeading\'>Current Loans and Credit Cards</h2>The total of all current loan payments is CURRENT_LOANS_INITIAL_PAYMENT. This is based on the loans and payment information shown below. <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>Current Loans</caption> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder KJECell40">&nbsp;</th><td class="KJECellStrong KJECellBorder KJECell20">Amount Owed</td><td class="KJECellStrong KJECellBorder KJECell20">Monthly Payment</td><td class="KJECellStrong KJECell20">Payments Left</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Loan one</th><td class="KJECell KJECellBorder">AUTO_LOAN_AMOUNT_OWED </td><td class="KJECell KJECellBorder">AUTO_LOAN_PAYMENT</td><td class="KJECell">AUTO_LOAN_MONTHS_LEFT</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Loan two</th><td class="KJECell KJECellBorder">AUTO_LOAN_2_AMOUNT_OWED </td><td class="KJECell KJECellBorder">AUTO_LOAN_2_PAYMENT</td><td class="KJECell">AUTO_LOAN_2_MONTHS_LEFT</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Loan three</th><td class="KJECell KJECellBorder">EDUCATION_LOANS_AMOUNT_OWED </td><td class="KJECell KJECellBorder">EDUCATION_LOANS_PAYMENT</td><td class="KJECell">EDUCATION_LOANS_MONTHS_LEFT</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Loan four</th><td class="KJECell KJECellBorder">BOAT_RV_LOANS_AMOUNT_OWED </td><td class="KJECell KJECellBorder">BOAT_RV_LOANS_PAYMENT</td><td class="KJECell">BOAT_RV_LOANS_MONTHS_LEFT</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Other loans</th><td class="KJECell KJECellBorder">OTHER_LOANS_AMOUNT_OWED</td><td class="KJECell KJECellBorder">OTHER_LOANS_PAYMENT</td><td class="KJECell">OTHER_LOANS_MONTHS_LEFT</td></tr></table> </div> <div class=KJEReportTableDiv><table class=KJEReportTable><caption class=\'KJEHeaderRow KJEHeading\'>Credit Card / Credit Line Summary</caption> <tr class=KJEFooterRow><th class="KJELabel KJECellBorder KJECell40">&nbsp;</th><td class="KJECellStrong KJECellBorder KJECell20">Amount Owed</td><td class="KJECellStrong KJECellBorder KJECell20">Monthly Payment</td><td class="KJECellStrong KJECell20">Interest Rate</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Card / line 1</th><td class="KJECell KJECellBorder">CREDIT_CARD_1_AMOUNT</td><td class="KJECell KJECellBorder">CREDIT_CARD_1_PAYMENT</td><td class="KJECell">CREDIT_CARD_1_RATE</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Card / line 2</th><td class="KJECell KJECellBorder">CREDIT_CARD_2_AMOUNT</td><td class="KJECell KJECellBorder">CREDIT_CARD_2_PAYMENT</td><td class="KJECell">CREDIT_CARD_2_RATE</td></tr> <tr class=KJEEvenRow><th class="KJELabel KJECellBorder">Card / line 3</th><td class="KJECell KJECellBorder">CREDIT_CARD_3_AMOUNT</td><td class="KJECell KJECellBorder">CREDIT_CARD_3_PAYMENT</td><td class="KJECell">CREDIT_CARD_3_RATE</td></tr> <tr class=KJEOddRow><th class="KJELabel KJECellBorder">Other account</th><td class="KJECell KJECellBorder">OTHER_ACCOUNT_AMOUNT </td><td class="KJECell KJECellBorder">OTHER_ACCOUNT_PAYMENT</td><td class="KJECell">OTHER_ACCOUNT_RATE</td></tr></table> </div> <h2 class=\'KJEScheduleHeader KJEFontHeading\'>New Loan Payment Schedule</h2> **REPEATING GROUP** ';