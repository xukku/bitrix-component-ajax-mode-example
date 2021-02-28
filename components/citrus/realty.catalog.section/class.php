<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

$parentComponentName = 'bitrix:catalog.section';
CBitrixComponent::includeComponentClass($parentComponentName);

class CitrusRealtyCatalogSectionComponent extends CatalogSectionComponent
{
	protected function getFilter()
	{
		$filterFields = parent::getFilter();
		$filterFields['ACTIVE_DATE'] = \Citrus\Arealty\Entity\SettingsTable::getValue('USE_ACTIVE_DATE') == 'N' ? '' : 'Y';
		$filterFields['PROPERTY_draft_for'] = false;

		return $filterFields;
	}

	protected function makeOutputResult()
	{
		parent::makeOutputResult();

		if (is_array($this->arResult['ITEMS']))
		{
			foreach ($this->arResult['ITEMS'] as $i => $v)
			{
				\Citrus\Arealty\Entity\CurrenciesTable::initBaseCostForItem($this->arResult['ITEMS'][$i]);
			}
		}
	}

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

		parent::executeComponent();
	}
}