<?php

use Citrus\Arealty\Template\TemplateHelper;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class CitrusArealtyCatalogSectionListComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		$request = \Bitrix\Main\Context::getCurrent()->getRequest();
		if ($request->isAjaxRequest())
		{
			$ajaxId = $request->get('bxajaxid'); // id компонента который обновляется через ajax
			if ($ajaxId)
			{
				if ($ajaxId != $this->arParams['AJAX_ID'])
				{
					// пропустить обработку компонента
					return;
				}
				/*
				\Bitrix\Main\Diag\Debug::writeToFile([
					'REQUEST_URI' => $_SERVER['REQUEST_URI'],
					'AJAX_MODE' => $this->arParams['AJAX_MODE'],
					'AJAX_ID' => $this->arParams['AJAX_ID'],
				], __METHOD__);
				*/
			}
		}

		if (!is_numeric($this->arParams['IBLOCK_ID'])) {
			$this->arParams['IBLOCK_ID'] = TemplateHelper::getIblock($this->arParams['IBLOCK_ID']);
		}

		$this->includeComponentTemplate();
	}
}