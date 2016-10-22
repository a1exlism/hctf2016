/**
 * Created by a1exlism on 16-10-18.
 */
'use strict'
$(function () {
	//  settings 作为主页
	
	function addCSS(url) {
		$('<link>').attr({
			rel: 'stylesheet',
			type: 'text/css',
			href: url
		}).appendTo('head');
	}
	
	function addJS(url) {
		$('<script>').attr({
			src: url
		}).appendTo('body');
	}
	
	function isExist(sname, stype) {
		var typeReg = new RegExp(sname, 'gi');
		var statusCode = 0;
		if (stype === 'css') {
			$('link').each(function () {
				if (this.href.indexOf(sname) !== -1) {
					// alert('CSS已存在');
					statusCode = 1;
					return true;  //中断当前循环
				}
			});
		} else if (stype === 'js') {
			$('script').each(function () {

				if (this.src.indexOf(sname) !== -1) {
					// alert('JS已存在');
					statusCode = 1;
					return true;
				}
				
			});
		}
		return statusCode;
	}
	
	//  动态加载静态资源 css/js
	function getSource(sname, stype) {
		stype = stype || 'js';  //默认以js加载
		
		if (isExist(sname, stype) == 1) {
			return false;
		} else {
			$.ajax({
				url: 'Team_ajax/get_source',
				method: 'POST',
				dataType: 'json',
				data: {
					name: sname,
					type: stype
				},
				success: function (data) {
					var resultUrl = data.url.replace(/[\\]/g, '');
					if (data.type === 'js') {
						addJS(resultUrl);
					} else {
						addCSS(resultUrl);
					}
				}
			});
		}
	}
	
	var getBulletin = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/bulletin');
		getSource('team_bulletin', 'css');
		getSource('team_bulletin', 'js');
	};
	
	var getChanllenge = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/challenge');
		getSource('team_challenge', 'css');
		getSource('team_challenge', 'js');
	};
	
	var getRank = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/rank');
		getSource('team_rank', 'css');
		getSource('team_rank', 'js');
	};
	
	var getSolved = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/solved');
		getSource('team_solved', 'css');
		getSource('team_solved', 'js');
	};
	
	var getSettings = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/settings');
		getSource('team_settings', 'css');
		getSource('team_settings', 'js');
	};
	
	$('#toggle-bulletin').click(getBulletin);
	$('#toggle-challenge').click(getChanllenge);
	$('#toggle-rank').click(getRank);
	$('#toggle-solved').click(getSolved);
	$('#toggle-settings').click(getSettings);
});
