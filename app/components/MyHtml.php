<?php

namespace app\components;

use \yii\helpers\Html;


class MyHtml extends Html
{
	/**
	* Generates an input tag for the given model attribute.
	* This method will generate the "name" and "value" tag attributes automatically for the model attribute
	* unless they are explicitly specified in `$options`.
	* @param string $type the input type (e.g. 'text', 'password')
	* @param Model $model the model object
	* @param string $attribute the attribute name or expression. See [[getAttributeName()]] for the format
	* about attribute expression.
	* @param array $options the tag options in terms of name-value pairs. These will be rendered as
	* the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	* @return string the generated input tag
	*/
	public static function activeInput($type, $model, $attribute, $options = array())
	{
		$name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
		$value = isset($options['value']) ? $options['value'] : static::getAttributeValue($model, $attribute);
		if (!array_key_exists('id', $options)) {
			$options['id'] = static::getInputId($model, $attribute);
		}
		return static::input($type, $name, $value, $options);
	}

	/**
	* Generates a text input tag for the given model attribute.
	* This method will generate the "name" and "value" tag attributes automatically for the model attribute
	* unless they are explicitly specified in `$options`.
	* @param Model $model the model object
	* @param string $attribute the attribute name or expression. See [[getAttributeName()]] for the format
	* about attribute expression.
	* @param array $options the tag options in terms of name-value pairs. These will be rendered as
	* the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	* @return string the generated input tag
	*/

	public static function activeTextInput($model, $attribute, $options = array())
	{
		return '<div class="input-control text">'.static::activeInput('text', $model, $attribute, $options).'</div>';
	}

	/**
	* Generates a text area input.
	* @param string $name the input name
	* @param string $value the input value. Note that it will be encoded using [[encode()]].
	* @param array $options the tag options in terms of name-value pairs. These will be rendered as
	* the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	* If a value is null, the corresponding attribute will not be rendered.
	* @return string the generated text area tag
	*/
	public static function textarea($name, $value = '', $options = array())
	{
		$options['name'] = $name;
		return '<div class="input-control textarea">'.static::tag('textarea', static::encode($value), $options).'</div>';
	}

	/**
	* Generates a textarea tag for the given model attribute.
	* The model attribute value will be used as the content in the textarea.
	* @param Model $model the model object
	* @param string $attribute the attribute name or expression. See [[getAttributeName()]] for the format
	* about attribute expression.
	* @param array $options the tag options in terms of name-value pairs. These will be rendered as
	* the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	* @return string the generated textarea tag
	*/
	public static function activeTextarea($model, $attribute, $options = array())
	{
		$name = static::getInputName($model, $attribute);
		$value = static::getAttributeValue($model, $attribute);
		if (!array_key_exists('id', $options)) {
			$options['id'] = static::getInputId($model, $attribute);
		}
		return static::textarea($name, $value, $options);
	}

	/**
	* Generates a password input field.
	* @param string $name the name attribute.
	* @param string $value the value attribute. If it is null, the value attribute will not be generated.
	* @param array $options the tag options in terms of name-value pairs. These will be rendered as
	* the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	* If a value is null, the corresponding attribute will not be rendered.
	* @return string the generated button tag
	*/
	public static function passwordInput($name, $value = null, $options = array())
	{
		return '<div class="input-control password">'.static::input('password', $name, $value, $options).'</div>';
	}

	public static function activePasswordInput($model, $attribute, $options = array())
	{
		$name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
		$value = isset($options['value']) ? $options['value'] : static::getAttributeValue($model, $attribute);
		if (!array_key_exists('id', $options)) {
			$options['id'] = static::getInputId($model, $attribute);
		}
		return '<div class="input-control password">'.static::passwordInput($name, $value, $options).'</div>';
	}

	/**
	* Generates a search input field.
	* @param string $name the name attribute.
	* @param string $value the value attribute. If it is null, the value attribute will not be generated.
	* @param array $options the tag options in terms of name-value pairs. These will be rendered as
	* the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	* If a value is null, the corresponding attribute will not be rendered.
	* @return string the generated button tag
	*/
	public static function activeSearchInput($model, $attribute, $options = array())
	{
		$name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
		$value = isset($options['value']) ? $options['value'] : static::getAttributeValue($model, $attribute);
		if (!array_key_exists('id', $options)) {
			$options['id'] = static::getInputId($model, $attribute);
		}
		return '<div class="input-append">'.static::input('text', $name, $value, $options).'<button type="submit" class="btn">Go</button></div>';
	}

	/**
	 * Generates a checkbox input.
	 * @param string $name the name attribute.
	 * @param boolean $checked whether the checkbox should be checked.
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	 *
	 * - uncheck: string, the value associated with the uncheck state of the checkbox. When this attribute
	 *   is present, a hidden input will be generated so that if the checkbox is not checked and is submitted,
	 *   the value of this attribute will still be submitted to the server via the hidden input.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting tag. The values will
	 * be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 *
	 * @return string the generated checkbox tag
	 */
	public static function checkbox($name, $checked = false, $options = array())
	{
		$options['checked'] = $checked;
		$value = array_key_exists('value', $options) ? $options['value'] : '1';
		if (isset($options['uncheck'])) {
			// add a hidden field so that if the checkbox is not selected, it still submits a value
			$hidden = static::hiddenInput($name, $options['uncheck']);
			unset($options['uncheck']);
		} else {
			$hidden = '';
		}
		return $hidden . static::input('checkbox', $name, $value, $options);
	}

	/**
	 * Generates a checkbox tag for the given model attribute.
	 * This method will generate the "name" tag attribute automatically unless it is explicitly specified in `$options`.
	 * This method will generate the "checked" tag attribute according to the model attribute value.
	 * @param Model $model the model object
	 * @param string $attribute the attribute name or expression. See [[getAttributeName()]] for the format
	 * about attribute expression.
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	 *
	 * - uncheck: string, the value associated with the uncheck state of the radio button. If not set,
	 *   it will take the default value '0'. This method will render a hidden input so that if the radio button
	 *   is not checked and is submitted, the value of this attribute will still be submitted to the server
	 *   via the hidden input.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting tag. The values will
	 * be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 *
	 * @return string the generated checkbox tag
	 */
	public static function activeCheckbox($model, $attribute, $options = array())
	{
		$name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
		$checked = static::getAttributeValue($model, $attribute);
		if (!array_key_exists('uncheck', $options)) {
			$options['uncheck'] = '0';
		}
		if (!array_key_exists('id', $options)) {
			$options['id'] = static::getInputId($model, $attribute);
		}
		return '<div class="input-control checkbox">'. static::checkbox($name, $checked, $options).'</div>';
	}

}
