/**
 * Created by a1exlism on 16-10-18.
 */
'use strict'
$(function () {
	//  settings 作为主页
	var getBulletin = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/bulletin');
	};

	var getChanllenge = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/challenge');
	};

	var getRank = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/rank');
	};

	var getSolved = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/solved');
	};

	var getSettings = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/settings');
	};
	
	$('#toggle-bulletin').click(getBulletin);
	$('#toggle-challenge').click(getChanllenge);
	$('#toggle-rank').click(getRank);
	$('#toggle-solved').click(getSolved);
	$('#toggle-settings').click(getSettings);
	
});
