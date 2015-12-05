<?php

function test_input($check, $should_be, $vanity = null) {
	if($check === $should_be) {
		return '<strong style="background-color: green; color: white; padding: 2px 4px; margin-bottom: 2px; display: inline-block;">' . (is_null($vanity) ? $check . ' === ' . $should_be : $vanity). '</strong> (Should be: ' . (($should_be) ? 'true' : 'false') . ')<br>';
	} else {
		return '<span style="background-color: red; color: white; padding: 2px 4px; margin-bottom: 2px; display: inline-block;">' . (is_null($vanity) ? $check . ' !== ' . $should_be : $vanity) . '</span>(Should be: ' . (($should_be) ? 'true' : 'false') . ')<br>';
	}
}