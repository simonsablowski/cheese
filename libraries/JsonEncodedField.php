<?php

class JsonEncodedField extends Field {
	public function decode($value) {
		return Json::decode($value);
	}
}