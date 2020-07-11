<?php 
include("include/classes.php");
$main_cls=new main();
$site_status=$main_cls->select("select * from settings");
$settings=$site_status->fetch_assoc();
?>


/**
author:developersharif;
author url:google.com/search?q=developersharif;
**/
body{
	background-color: #f1f1f1;
}
.navbar {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 0px 10px;
}
.float-right{
	float: right!important;
}
.border-left{
	    border-left: 3px solid #009688!important;
}
.noticeboard{
	    border-left-style: solid;
    border-left-color: #009688d1;
    border-left-width: 140px;
    border-radius: 4px;
        background: #dadada;
}
.notice-t{
	    position: absolute;
    left: 40px;
    color: whitesmoke;
}
.popular img{
	max-height: 60px;
    border-radius: 5px;
    box-shadow: 1px -2px #cacaca;
    max-width: -webkit-fill-available;
}
.post-card{
	    margin-bottom: 10px;
      overflow: hidden;
}

.post-card .categories {
    position: absolute;
    top: 159px;
    right: 5px;
    padding: 5px;
    border-radius: 20px;
    background: #ffffffd9;
    box-shadow: 2px 1px lightgrey;
    color: darkslategray;
    font-size: 15px;
    margin-left: 4px;
    font-family: sans-serif;
}
.post-card .card-img-top{
	    max-height: 180px;
}
.post-card .card-img-thumb{
	 filter: brightness(0.5);
    width: auto;
    max-height: max-content;
}
.post-card .card-title {
    margin-bottom: 5px;
    font-family: inherit;
}
.post-card .post-text{
	    color: black;
    font-size: small;
}
.post-title {
    position: relative;
    background: #332d2d33;
    width: 100%;
    overflow: hidden;
    text-align: justify;
    font-size: 12px;
    border-left: 4px solid #009688;
    padding-left: 3px;
}
.post-text-full{
	    color: black;
    font-size: small;
    text-align: justify;
}
.post-info{
	    border-top: 1px solid #e4e4e4;
    font-size: smaller;
    padding: 5px 10px;
}
.post-card .inner-post{
	max-width: 100%;
        max-height: 356px;
}
.post-card .date{
	    float: right;
    font-style: oblique;
    color: dimgray;
}
.author-info .avatar {
    height: 72px;
    width: 75px;
    border-radius: 50px;
    filter: drop-shadow(0px 1px 1px gray);
    margin-right: 5px;
}
.post-card .p-date {
    font-size: 14px;
    color: gray;
    width: fit-content;
    border-bottom: 2px solid lightgray;
}
.post-card .title{
  font-size: 17px;
    font-family: sans-serif;
}
button.note-btn.btn.btn-light.btn-sm.btn-codeview {
    display: none;
}
.align-right{
    float: right;
}
.align-center{
    text-align: center;
}
.bg-black{
    background-color: black;
    color:white;
}
.bg-gray{
    background-color: gray;

}

.frame{
max-width:350px;
border-radius:20px;
margin:auto;
background:rgba(0, 0, 0, 0.62);
box-sizing:border-box;
padding:20px;
colour:#fff;
margin-top:50px;
margin-bottom:20px;
}
body.signup{
background: linear-gradient(to bottom, #d4cbcb,#117a8b);
}
.frame h2{
 text-align:center;
 color:#dae0e5;
}
.frame span{
    color: #bd2130;
    font-size: xx-small;
}
.frame input[type=text],input[type=password],input[type=tel],input[type=email]{
                   width:100%;
                   box-sizing:border-box;
                   padding:12px 5px;
               background:rgba(0,0,0,0.10);
           outline:none;
           border:none;
           border-bottom:1px dotted #fff;
           color:#fff;
           border-radius:5px;
           margin:5px;
           font-weight:bold;
}
.frame input[type=submit]{
                   width:100%;
                   box-sizing:border-box;
                   padding:10px 0;
                   outline:none;
                   border:none;
                   background:#1c9535;
                   opacity:0.7;
                   border-radius:20px;
                   font-size:20px;
                   color:#fff;
}
.noscript{
    animation: noscript 5s linear infinite;
    transition: 1s;
}
@keyframes noscript {
     0%   {background-color: red; left:0px; top:0px; transform: scale(1);border-radius:5px;}
    25%  {background-color: yellow; left:200px; top:0px;}
    50%  {background-color: blue; left:200px; top:200px;}
    75%  {background-color: red; left:0px; top:200px;}
    100% {background-color: deeppink; left:0px; top:0px;transform: scale(.5);border-radius:5px;}
 }

