<?php

namespace Localhost\Custom;

use Bitrix\Main\Page\Asset;

function registerEvents()
{
	AddEventHandler('main', 'OnEpilog', function () {
		Asset::getInstance()->addJs('/local/assets/js/fix_ajax_progress.js');
	});
}

function main()
{
	registerEvents();
}

main();
