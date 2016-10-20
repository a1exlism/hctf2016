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
	
	//  动态加载静态资源
	function getSource(sname, stype) {
		stype = stype || 'js';  //默认以js加载
		$.ajax({
			url: 'Team_ajax/get_source',
			method: 'POST',
			dataType: 'json',
			data: {
				name: sname,
				type: stype
			},
			//  成功就把数据加载进来
			success: function (data) {
				var resultUrl = data.url.replace(/[\\]/g,'');
				console.log(data);
				if (data.type == 'js') {
					$.ajax({
						url: resultUrl,
						method: 'GET',
						dataType: 'script'
					});
				} else {
					addCSS(resultUrl);
				}
			}
		})
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
