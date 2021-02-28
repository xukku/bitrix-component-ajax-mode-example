<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

//NOTE индикация подгрузки защита в ядре \bitrix\modules\main\install\js\main\core\core.js:17479 и похоже теперь не кастомизируется

$tabId = (int)$arParams['~DATA']['TAB'];
$tabId++;
if ($tabId > 1)
{
	$tabId = 0;
}

$navigationUrl = $APPLICATION->GetCurPageParam('tab=' . $tabId, [
	'tab',
	'success',
]);

?>

<div align="center">
	<a href="<?= $navigationUrl ?>">Обновить блок</a>

	<h3>Блок: <?= $tabId? 'citrus.form' : 'main.feedback'; ?> [<?= date('Y-m-d H:i:s') ?>]</h3>
</div>

<?php if ($tabId == 0) { ?>

	<?$APPLICATION->IncludeComponent(
		"citrus.core:include",
		".default",
		array(
			"AREA_FILE_SHOW" => "component",
			"_COMPONENT" => "bitrix:main.feedback",
			"_COMPONENT_TEMPLATE" => ".default",
			"PAGE_SECTION" => "N",
			"PADDING" => "N",
			"COMPOSITE_FRAME_MODE" => "A",
			"COMPOSITE_FRAME_TYPE" => "AUTO",

			"USE_CAPTCHA" => "Y",
	        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
	        "EMAIL_TO" => "my@email.com",
	        "REQUIRED_FIELDS" => Array("NAME","EMAIL","MESSAGE"),
	        "EVENT_MESSAGE_ID" => Array("5")
		),
		false
	);?>

<?php } else if ($tabId == 1) { ?>

	<?$APPLICATION->IncludeComponent(
		"citrus.core:include",
		'.default',
		[
			"AREA_FILE_SHOW" => "sect",
			"AREA_FILE_SUFFIX" => "form_staff_order_call",
			"PAGE_SECTION" => "N",
			"PADDING" => "N",
		],
		$component
	);?>

<?php } ?>