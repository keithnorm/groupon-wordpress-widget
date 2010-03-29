<?php 
  header('Content-type: text/css');
?>

#groupon_widget {
  position:relative;
}
#groupon_widget td{
  font-size: 12px;
  text-align: center;
}

#groupon_widget .pad_10{
  padding: 10px;
}

#groupon_widget.rounded_on{
  -moz-border-radius: 8px;
  -webkit-border-radius: 8px; 
}

#groupon_widget.get_it_rounded{
  -moz-border-radius: 95px;
  -webkit-border-radius: 95px;
}

#groupon_widget .rounded_on{
  -moz-border-radius: 8px;
  -webkit-border-radius: 8px; 
}

#groupon_widget .get_it_rounded{
  -moz-border-radius: 95px;
  -webkit-border-radius: 95px;
}

#groupon_widget .bold{
  font-weight: bold;
}

#groupon_widget a:link, #groupon_widget a:visited, #groupon_widget a:hover, #groupon_widget a:active{
  color: #<?php echo $_GET["grpn_wdgt_link_color"]; ?>;
  text-decoration: none;
}

#groupon_widget a:hover{
  text-decoration: underline;
}

#groupon_widget{
  width: 296px;
  overflow: hidden;
  background: #<?php echo $_GET["grpn_wdgt_shell_background"]; ?> url(images/rays.png) no-repeat left top;
  padding: 5px 2px 0 2px;
  margin:auto;
}

#groupon_widget h1{
  background: url("images/logo.png") no-repeat 4px center;
  padding: 9px 0 5px 85px;
  margin:0 0 5px 7px;
  color: #<?php echo $_GET["grpn_wdgt_title_color"]; ?>;
  font-size: 14px;
  min-height: 25px;
}
#groupon_widget h1 span{
  text-transform:capitalize;
}

#groupon_box{
  overflow: hidden;
  background: #FFF;
  padding: 10px 2px;
  margin-bottom: 5px;
}

#groupon_box h2{
  padding: 0 0 0 10px;
  margin-bottom: 5px;
  font-size: 14px;
  line-height: 18px;
}

#groupon_widget #left, #groupon_widget #right{
  float: left;
}

#groupon_widget #left{
  width: 35%;
  margin-right: 1px;
}

#groupon_widget #right{
  width: 64%;
}

  #groupon_widget #deal_image img {
    width: 170px;
  }
  #groupon_widget a img {
    border: none;
  }
#groupon_widget #right p{
  width: 98%;
  height: 104px;
  color: #555;
  text-align: center;
  padding:0;
  margin: 0 0 10px 0;
}

#groupon_widget #price_tag_wrap{
  float: left;
  overflow: hidden;
  position: relative;
}

#groupon_widget #price_tag_wrap #triangle{
  font-size: 0px; line-height: 0%;
  width: 0;
  border-top: 16px solid #fff;
  border-bottom: 16px solid #fff;
  border-left: 1px solid #fff;
  border-right: 11px solid #<?php echo $_GET["grpn_wdgt_price_tag_background"]; ?>;
  position:relative;
  float: left;
  z-index: 10;
}

#groupon_widget #price_tag_wrap #triangle #hole{
  width:7px;
  height:7px;
  position:absolute;
  top:-3px;
  left:7px;
}

#groupon_widget #price_tag_wrap #price_tag{
  background: #<?php echo $_GET["grpn_wdgt_price_tag_background"]; ?>;
  width: 96px;
  height: 33px;
  position: relative;
  left: 12px;
  z-index: 9;
}

#groupon_widget #price_tag h2 {
  color: #fff;
  font-weight:700;
  font-size:24px;
  line-height:30px;
  padding: 0 0 0 10px;
  margin: 0;
}

#groupon_widget table{
  width: 100%;
  clear: left;
}

#groupon_widget table#breakdown tr td{
  width: 33%;
}

#groupon_widget table#number_bought{
  width: 100%;
  padding-top:10px;
}
#groupon_widget #breakdown th{
  font-size:10px;
  font-weight:normal;
}
#groupon_widget table#number_bought tr td#number{
  font-size: 24px;
}

#groupon_widget table#time_left th td{
  width: 100%;
  text-align: center;
}

#groupon_widget table#time_left_label{
  padding-top:10px;
}
#groupon_widget table#time_left tr td{
  width: 25%;
  font-size:18px;
}
#groupon_widget table#time_left tr td.number{
  width: 25%;
}
#groupon_widget table#time_left tr td.label{
  width: 25%;
  font-size:10px;
  font-weight:normal;
}

#groupon_widget #grpn_wdgt_footer a{
  float: right;
  background: #FFF;
  margin: 0 8px 5px 0;
  padding: 2px 5px;
  font-size: 12px;
}

#groupon_widget #get_it{
  position: relative;
  background: #<?php echo $_GET["grpn_wdgt_get_it_btn_background"]; ?>;
  width: 145px;
  height: 67px;
  margin: 0 auto;
}

#groupon_widget #get_it a{
  position: absolute;
  background: url("images/get_it_overlay.png") no-repeat top left;
  top: -1px;
  left: 0;
  width: 100%;
  height: 100%;
  text-align: center;
  font-size: 24px;
  color: #FFF;
  padding-top: 27px;
}

#groupon_widget #get_it a:hover{
  text-decoration: none;
}