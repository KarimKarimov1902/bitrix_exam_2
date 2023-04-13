<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
CJSCore::Init(array("jquery"));
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta property="special" content="<?$APPLICATION->ShowProperty("special")?>"/>
<meta property="specialdate" content="<?$APPLICATION->ShowProperty("specialdate")?>" />
<?$APPLICATION->ShowProperty("canonical");?>
<?$APPLICATION->ShowHead();?>
<link href="<?=SITE_TEMPLATE_PATH?>/common.css" type="text/css" rel="stylesheet" />
<link href="<?=SITE_TEMPLATE_PATH?>/colors.css" type="text/css" rel="stylesheet" />

	<!--[if lte IE 6]>
	<style type="text/css">
		
		#banner-overlay { 
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/overlay.png', sizingMethod = 'crop'); 
		}
		
		div.product-overlay {
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/product-overlay.png', sizingMethod = 'crop');
		}
		
	</style>
	<![endif]-->

	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<style>
	.extremum-slide {
		border:1px solid;
		padding:50px;
		display: none;
	}
	.extremum-click{
		cursor: pointer
	}
	.spanny{
		color: green;
	}
</style>
<body>
	<div id="page-wrapper">
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<div id="header" style="<?$APPLICATION->ShowProperty("head_style")?>"><? // ex2-109 ?>
			<table id="logo">
				<tr>
					<td>
						<a href="<?=SITE_DIR?>" title="<?=GetMessage('CFT_MAIN')?>">
							<?$APPLICATION->IncludeFile(
								SITE_DIR."include/company_name.php",
								Array(),
								Array("MODE"=>"html")
							);?>
						</a>
					</td>
				</tr>
			</table>
			
			
			
			
			<div id="top-menu">
				<div id="top-menu-inner">
<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel", array(
	"ROOT_MENU_TYPE" => "top",
	"MAX_LEVEL" => "2",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
				</div>
			</div>
			
			<div id="top-icons">
				<a href="<?=SITE_DIR?>" class="home-icon" title="<?=GetMessage('CFT_MAIN')?>"></a>
				<a href="<?=SITE_DIR?>search/" class="search-icon" title="<?=GetMessage('CFT_SEARCH')?>"></a>
				<a href="<?=SITE_DIR?>contacts/" class="feedback-icon" title="<?=GetMessage('CFT_FEEDBACK')?>"></a>
			</div>
		
		</div>
		
		<div id="banner">		
			<table id="banner-layout" cellspacing="0">
				<tr>
					<td id="banner-image"><div><img src="<?=SITE_TEMPLATE_PATH?>/images/head.jpg" /></div></td>
					<td id="banner-slogan">
						<?$APPLICATION->ShowProperty("slogan_head"); // ex2-112?>
						<?/*$APPLICATION->IncludeFile(
							SITE_DIR."include/motto.php",
							Array(),
							Array("MODE"=>"html")
						);*/?>
					</td>
				</tr>
			</table>
			<div id="banner-overlay"></div>	
		</div>
		
		<div id="content">
			<div id="sidebar">

			<!-- ex2-101 -->
				<div class="content-block">
					<div class="content-block-inner">
						<h3><?=GetMessage('CFT_LANG_CANGE')?></h3>
							<?$APPLICATION->IncludeComponent(
							    "bitrix:main.site.selector",
							    "dropdown",
							    Array(
							        "SITE_LIST" => array(),
							        "CACHE_TYPE" => "A",
							        "CACHE_TIME" => "3600"
							    ),
							    false
							);?>
					</div>
				</div>
				<!-- End ex2-101 -->

				<?$APPLICATION->IncludeComponent("bitrix:menu", "left", array(
					"ROOT_MENU_TYPE" => "left",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "1",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "Y",
					"ALLOW_MULTI_SELECT" => "N"
					),
					false,
					array(
						"ACTIVE_COMPONENT" => "Y"
					)
				);?>
					<?$pieces = $APPLICATION->GetCurDir();
					$pieces = explode("/", $pieces);
					if ($pieces[4] == "ex2-30" || $pieces[4] == "ex2-31") {?>
						<div class="content-block  <?=$APPLICATION->ShowProperty("add_css_class_today_news");/* ex2-30, ex2-31 */?>">
					<?}else{?>
						<div class="content-block  <?$APPLICATION->ShowProperty("dop_class_style") /* ex2-42 */?>">
					<?}?>
					<div class="content-block-inner">
						<h3><?=GetMessage('CFT_NEWS')?></h3>
						<?
						$APPLICATION->IncludeFile(
							SITE_DIR."include/news.php",
							Array(),
							Array("MODE"=>"html")
						);
						?>
					</div>
				</div>
				

<?
$APPLICATION->IncludeFile(
	SITE_DIR."include/cat_page_tovar.php",
	Array(),
	Array("MODE"=>"html")
);
?>

				
				
				<div class="content-block">
					<div class="content-block-inner">
						<?
						$APPLICATION->IncludeComponent("bitrix:search.form", 
							"flat", 
							Array(
								"PAGE" => "#SITE_DIR#search/",
							),
							false
						);
						?>
					</div>
				</div>

				<? // ex2-82_70?>
					<?$APPLICATION->ShowViewContent('prices');?>
				<? // End ex2-82_70?>

				<div class="information-block">
					<div class="top"></div>
					<div class="information-block-inner">
						<h3><?=GetMessage('CFT_FEATURED')?></h3>
<?
$APPLICATION->IncludeFile(
	SITE_DIR."include/random.php",
	Array(),
	Array("MODE"=>"html")
);
?>						
					</div>
					<div class="bottom"></div>
				</div>
			</div>
		
			<div id="workarea">
				<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false);?></h1>


<script>
	$(document).ready(function() { 
		$(".extremum-click").click(function () {
			$(this).siblings(".extremum-slide").slideToggle("slow");
		});
	}); 
</script>