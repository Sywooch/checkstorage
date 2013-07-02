<?php

namespace app\components;

use \yii\widgets\ActiveField;
use \app\components\MyHtml;

class MyActiveField extends ActiveField
{

	public function textInput($options = array())
	{
		$options = array_merge($this->inputOptions, $options);
		return $this->render(MyHtml::activeTextInput($this->model, $this->attribute, $options));
	}

	public function searchInput($options = array())
	{
		$options = array_merge($this->inputOptions, $options);
		return $this->render(MyHtml::activeSearchInput($this->model, $this->attribute, $options));
	}

	/**
	* Generates a textarea tag for the given model attribute.
	* The model attribute value will be used as the content in the textarea.
	* @param array $options the tag options in terms of name-value pairs. These will be rendered as
	* the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	* @return string the generated textarea tag
	*/
	public function textarea($options = array())
	{
		$options = array_merge($this->inputOptions, $options);
		return $this->render(MyHtml::activeTextarea($this->model, $this->attribute, $options));
	}

	/**
	* Generates a password input tag for the given model attribute.
	* This method will generate the "name" and "value" tag attributes automatically for the model attribute
	* unless they are explicitly specified in `$options`.
	* @param array $options the tag options in terms of name-value pairs. These will be rendered as
	* the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	* @return string the generated input tag
	*/
	public function passwordInput($options = array())
	{
		$options = array_merge($this->inputOptions, $options);
		return $this->render(MyHtml::activePasswordInput($this->model, $this->attribute, $options));
	}

	/**
	* Renders a field containing a checkbox.
	* This method will generate the "name" tag attribute automatically unless it is explicitly specified in `$options`.
	* This method will generate the "checked" tag attribute according to the model attribute value.
	* @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	*
	* - uncheck: string, the value associated with the uncheck state of the radio button. If not set,
	* it will take the default value '0'. This method will render a hidden input so that if the radio button
	* is not checked and is submitted, the value of this attribute will still be submitted to the server
	* via the hidden input.
	*
	* The rest of the options will be rendered as the attributes of the resulting tag. The values will
	* be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
	* @param boolean $enclosedByLabel whether to enclose the checkbox within the label.
	* If true, the method will still use [[template]] to layout the checkbox and the error message
	* except that the checkbox is enclosed by the label tag.
	* @return string the rendering result
	*/
	public function checkbox($options = array(), $enclosedByLabel = true)
	{
		$options = array_merge($this->inputOptions, $options);
		if ($enclosedByLabel) {
			$hidden = '';
			$checkbox = MyHtml::activeCheckbox($this->model, $this->attribute, $options);
			if (($pos = strpos($checkbox, '><')) !== false) {
				$hidden = substr($checkbox, 0, $pos + 1);
				$checkbox = substr($checkbox, $pos + 1);
			}
			$label = isset($this->labelOptions['label']) ? $this->labelOptions['label'] : MyHtml::encode($this->model->getAttributeLabel($this->attribute));
			return $this->begin() . "\n" . $hidden . strtr($this->template, array(
				'{input}' => MyHtml::label("$checkbox $label", null, array('class' => 'checkbox')),
				'{label}' => '',
				'{error}' => $this->error(),
			)) . "\n" . $this->end();
		} else {
			return $this->render(MyHtml::activeCheckbox($this->model, $this->attribute, $options));
		}
	}

}