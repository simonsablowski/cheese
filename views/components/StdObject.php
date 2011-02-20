<?php

if (!function_exists('tabs')) {
	function tabs($number = 0) {
		global $indent;
		return str_repeat("\t", $indent + $number);
	}
}

if (!function_exists('dumpProperty')) {
	function dumpProperty($property, $value) {
		if (is_array($value)) {
			$dump = sprintf("%s<tr>\n%s<td>\n%s%s\n%s</td>\n%s<td>\n%s<table>\n", tabs(1), tabs(2), tabs(3), $property, tabs(2), tabs(2), tabs(3));
			foreach ($value as $itemsProperty => $itemsValue) {
				$dump .= dumpProperty(is_string($itemsProperty) ? $itemsProperty : $itemsProperty + 1, $itemsValue);
			}
			$dump .= sprintf("%s</table>\n%s</td>\n%s</tr>\n", tabs(3), tabs(2), tabs(1));
			return $dump;
		} else if (is_string($value) || is_int($value)) {
			return sprintf("%s<tr>\n%s<td>\n%s%s\n%s</td>\n%s<td>\n%s%s\n%s</td>\n%s</tr>\n", tabs(1), tabs(2), tabs(3), $property, tabs(2), tabs(2), tabs(3), Xml::cleanProperty($value), tabs(2), tabs(1));
		}
		return NULL;
	}
}

$indent = isset($indent) ? $indent : 1;

if (is_object($StdObject)) {
	printf("%s<table class=\"decoded\">\n", tabs($indent));
	foreach (get_object_vars($StdObject) as $property => $value) {
		print dumpProperty($property, $value);
	}
	printf("%s</table>", tabs($indent));
}