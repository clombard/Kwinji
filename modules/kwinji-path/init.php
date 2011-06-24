<?php

Route::set('paths', function($uri) {
	return Path::alias($uri, TRUE);
});