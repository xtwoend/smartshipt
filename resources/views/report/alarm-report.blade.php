<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
      <meta name="author" content="xtwoend" />
    <style type="text/css">
      html { font-family:sans-serif, Arial, Helvetica, sans-serif; font-size:9pt; background-color:white }
      a.comment-indicator:hover + div.comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em }
      a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em }
      div.comment { display:none }
      table { border-collapse:collapse; page-break-after:always }
      .gridlines td { border:1px dotted black }
      .gridlines th { border:1px dotted black }
      .b { text-align:center }
      .e { text-align:center }
      .f { text-align:right }
      .inlineStr { text-align:left }
      .n { text-align:right }
      .s { text-align:left }
      td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:white }
      th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:white }
      td.style1 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style1 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style2 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style2 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style3 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style3 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style4 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      th.style4 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      td.style5 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      th.style5 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      td.style6 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style6 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:#FFFFFF }
      th.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:#FFFFFF }
      td.style8 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:12pt; background-color:#FFFFFF }
      th.style8 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:12pt; background-color:#FFFFFF }
      td.style9 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style9 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style10 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:#FFFFFF }
      th.style10 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:#FFFFFF }
      td.style11 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:12pt; background-color:#FFFFFF }
      th.style11 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:12pt; background-color:#FFFFFF }
      td.style12 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style12 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style13 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:#FFFFFF }
      th.style13 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:#FFFFFF }
      td.style14 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style14 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style15 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style15 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style16 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style16 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style17 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style17 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style18 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style18 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style19 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style19 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style20 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style20 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style21 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style21 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style22 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style22 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style23 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style23 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style24 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style24 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style26 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style26 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      th.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#FFFFFF }
      td.style28 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style28 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style29 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style29 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style30 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style30 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style31 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style31 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style32 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style32 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style33 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style33 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style34 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style34 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style35 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      th.style35 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'sans-serif'; font-size:9pt; background-color:#FFFFFF }
      td.style36 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      th.style36 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      td.style37 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      th.style37 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      td.style38 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      th.style38 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      td.style39 { vertical-align:bottom; text-align:left; padding-left:18px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      th.style39 { vertical-align:bottom; text-align:left; padding-left:18px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      td.style40 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      th.style40 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'sans-serif'; font-size:8pt; background-color:#E7E6E6 }
      td.style41 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#1D273B; font-family:'Segoe UI'; font-size:8pt; background-color:#E7E6E6 }
      th.style41 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#1D273B; font-family:'Segoe UI'; font-size:8pt; background-color:#E7E6E6 }
      td.style42 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#1D273B; font-family:'Segoe UI'; font-size:8pt; background-color:#E7E6E6 }
      th.style42 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#1D273B; font-family:'Segoe UI'; font-size:8pt; background-color:#E7E6E6 }
      td.style43 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#1D273B; font-family:'Segoe UI'; font-size:8pt; background-color:#E7E6E6 }
      th.style43 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#1D273B; font-family:'Segoe UI'; font-size:8pt; background-color:#E7E6E6 }
      table.sheet0 col.col0 { width:200pt }
      table.sheet0 col.col1 { width:200pt }
      table.sheet0 col.col2 { width:200pt }
      table.sheet0 col.col3 { width:200pt }
      table.sheet0 col.col4 { width:200pt }
      table.sheet0 tr { height:16.363636363636pt }
      table.sheet0 tr.row0 { height:19pt }
      table.sheet0 tr.row1 { height:19pt }
      table.sheet0 tr.row2 { height:17pt }
      table > tr, td { padding: 0 5px; } 
    </style>
  </head>

  <body>
    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <tbody>
          <tr class="row0">
            <td class="column0 style7 s style13" rowspan="3">
              <img src="{{ public_path('/img/smartship.png') }}" title="PIS" height="80">
            </td>
            <td class="column1 style8 s style8" colspan="3">PT PERTAMINA INTERNATIONAL SHIPPING</td>
            <td class="column4 style9 s style15" rowspan="3">
              <img src="{{ public_path('/img/pis.png') }}" title="PIS">
            </td>
          </tr>
          <tr class="row1">
            <td class="column1 style11 s style11" colspan="3">ALARM REPORT DAILY</td>
          </tr>
          <tr class="row2">
            <td class="column1 style14 s style14" colspan="3">Smartship System - Fleet Management Solution</td>
          </tr>
          <tr class="row3">
            <td class="column0 style16 null">&nbsp;</td>
            <td class="column1 style16 null"></td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row4">
            <td class="column0 style16 null">&nbsp;</td>
            <td class="column1 style16 null"></td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row5">
            <td class="column0 style36 s">VESSEL</td>
            <td class="column1 style1 null">{{ $fleet->name }}</td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row6">
            <td class="column0 style37 s">SATELLITE TELEPHONE</td>
            <td class="column1 style2 null">{{ $fleet->telp }}</td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row7">
            <td class="column0 style37 s">SATELLITE EMAIL</td>
            <td class="column1 style3 null">{{ $fleet->email }}</td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row8">
            <td class="column0 style36 s">LAST UPDATE</td>
            <td class="column1 style1 null">{{ $fleet->last_connection }}</td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row9">
            <td class="column0 style37 s">POSITION</td>
            <td class="column1 style2 s">{{ $status[$fleet->fleet_status] }}</td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row10">
            <td class="column0 style37 s">CONNECTION</td>
            <td class="column1 style3 s">{{ $fleet->connected ? 'Good' : 'Lost' }}</td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row11">
            <td class="column0 style16 null">&nbsp;</td>
            <td class="column1 style16 null"></td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row12">
            <td class="column0 style16 null">&nbsp;</td>
            <td class="column1 style16 null"></td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row13">
            <td class="column0 style38 s">DATE</td>
            <td class="column1 style17 null">{{ $from }}</td>
            <td class="column2 style18 null style18" colspan="3"></td>
          </tr>
          <tr class="row14">
            <td class="column0 style38 s">CURRENT LOCATION</td>
            <td class="column1 style19 null style21" colspan="4"></td>
          </tr>
          <tr class="row15">
            <td class="column0 style39 s">LATITUDE</td>
            <td class="column1 style22 s style24" colspan="3">{{ $navigation->lat }}</td>
            <td class="column4 style4 s">{{ $navigation->lat_dir }}</td>
          </tr>
          <tr class="row16">
            <td class="column0 style39 s">LONGITUDE</td>
            <td class="column1 style22 null style24" colspan="3">{{ $navigation->lng }}</td>
            <td class="column4 style5 s">{{ $navigation->lng_dir }}</td>
          </tr>
          <tr class="row17">
            <td class="column0 style38 s">COURSE</td>
            <td class="column1 style22 null style24" colspan="3">{{ $navigation->cog }}</td>
            <td class="column4 style5 s">DEGREE</td>
          </tr>
          <tr class="row18">
            <td class="column0 style38 s">DISTANCE TO RUN</td>
            <td class="column1 style22 null style24" colspan="3">{{ $navigation->distance }}</td>
            <td class="column4 style5 s">NM</td>
          </tr>
          <tr class="row19">
            <td class="column0 style38 s">TOTAL DISTANCE TO RUN</td>
            <td class="column1 style22 null style24" colspan="3">{{ $navigation->total_distance }}</td>
            <td class="column4 style5 s">NM</td>
          </tr>
          <tr class="row20">
            <td class="column0 style38 s">AVERAGE SPEED</td>
            <td class="column1 style22 null style24" colspan="3">{{ $avgSpeed }}</td>
            <td class="column4 style5 s">KNOT</td>
          </tr>
          <tr class="row21">
            <td class="column0 style38 s">GENERAL AVERAGE SPEED</td>
            <td class="column1 style22 null style24" colspan="3">{{ $avgSpeed }}</td>
            <td class="column4 style5 s">KNOT</td>
          </tr>
          <tr class="row22">
            <td class="column0 style38 s">BY SPEED</td>
            <td class="column1 style22 null style24" colspan="3">{{ $navigation->sog }}</td>
            <td class="column4 style5 s">KNOT</td>
          </tr>
          <tr class="row23">
            <td class="column0 style38 s">RPM (REV PER MINUTE)</td>
            <td class="column1 style22 null style24" colspan="3">{{ $fleet->engine()?->rpm }}</td>
            <td class="column4 style5 s">RPM</td>
          </tr>
          <tr class="row24">
            <td class="column0 style38 s">WEATHER CONDITION</td>
            <td class="column1 style25 null style27" colspan="4">speed {{$navigation->wind_speed}}, scale {{ scaleBeafort($navigation->wind_speed) }}, direction {{ $navigation->wind_direction }}</td>
          </tr>
          <tr class="row25">
            <td class="column0 style16 null">&nbsp;</td>
            <td class="column1 style16 null"></td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row26">
            <td class="column0 style16 null">&nbsp;</td>
            <td class="column1 style16 null"></td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row27">
            <td class="column0 style6 s" colspan="2">INFORMATION ALARM LOG</td>
            <td class="column1 style16 null"></td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
          </tr>
          <tr class="row28">
            <td class="column0 style16 null"></td>
            <td class="column1 style16 null"></td>
            <td class="column2 style16 null"></td>
            <td class="column3 style16 null"></td>
            <td class="column4 style16 null"></td>
          </tr>
          <tr class="row29">
            <td class="column0 style40 s">DATE</td>
            <td class="column1 style41 s style42" colspan="2">MESSAGE</td>
            <td class="column3 style43 s">DURATION</td>
            <td class="column4 style43 s">STATUS</td>
          </tr>
          @foreach($alarms as $alarm)
          <tr class="row30">
            <td class="column0 style28 null">{{ $alarm->started_at }}</td>
            <td class="column1 style29 null style30" colspan="2">{{ $alarm->message }}</td>
            <td class="column3 style28 null">{{ $alarm->duration }}</td>
            <td class="column4 style31 null">{{ $alarm->status ? 'OPEN' : 'CLOSE'}}</td>
          </tr>
          @endforeach
        </tbody>
    </table>
  </body>
</html>
