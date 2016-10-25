<?php
/**
 * Created by PhpStorm.
 * User: a1exlism
 * Date: 16-10-19
 * Time: 下午1:26
 */
?>


<div id="team-settings" class="container">
	<div class="row">
		<h1>Team Info</h1>
		<div class="col-md-8 main-content">
			<div id="team-solved" class="row">
				<div class="solved-title">
					<a>Challenges Solved</a>
				</div>
				<div class="solved-body">
					<dl>
						<dt>
							<span class="cha-name">Welcome </span>
							|<span class="cha-type">reverse</span>
						</dt>
						<dd>
							Score:<span class="cha-score">100</span>
							| Solved at <span class="cha-solved-time">Oct 25 19:06:40</span>
							| Solved num:<span class="cha-solved-num">200</span>
						</dd>
						<dt>
							<span class="cha-name">Welcome </span>
							|<span class="cha-type">reverse</span>
						</dt>
						<dd>
							Score:<span class="cha-score">100</span>
							| Solved at <span class="cha-solved-time">Oct 25 19:06:40</span>
							| Solved num:<span class="cha-solved-num">200</span>
						</dd>
						<dt>
							<span class="cha-name">Welcome </span>
							|<span class="cha-type">reverse</span>
						</dt>
						<dd>
							Score:<span class="cha-score">100</span>
							| Solved at <span class="cha-solved-time">Oct 25 19:06:40</span>
							| Solved num:<span class="cha-solved-num">200</span>
						</dd>
						<dt>
							<span class="cha-name">Welcome </span>
							|<span class="cha-type">reverse</span>
						</dt>
						<dd>
							Score:<span class="cha-score">100</span>
							| Solved at <span class="cha-solved-time">Oct 25 19:06:40</span>
							| Solved num:<span class="cha-solved-num">200</span>
						</dd>
					</dl>

					<!-- todo: Load More -->
				</div>
			</div>
		</div>
		<div class="col-md-offset-1 col-md-3 sidebar">
			<div class="row">
				<div id="team-ranking" class="col-md-offset-1 col-md-10">
					<a>Team Ranking</a>
					<div>
						<p class="team-level">Level: <span>10</span></p>
						<p class="team-score">Total Score: <span>1800</span></p>
						<p class="team-ranking">Ranking: <span>1</span></p>
					</div>
					<a href="javascript:0;" class="msg-btn">Change Passwd</a>
				</div>

				<div id="pass-change" class="col-xs-12">
					<form>
						<div class="form-group">
							<!--							<label for="origin-pass">Origin Passwd:</label>-->
							<input type="password" placeholder="Origin Passwd" class="form-control" id="ori-pass" name="ori-pass">
						</div>
						<div class="form-group">
							<!--							<label for="new-pass">New Passwd:</label>-->
							<input type="password" placeholder="New Passwd" class="form-control" id="new-pass" name="new-pass">
						</div>
						<input type="button" class="btn submit-btn" value="Submit">
						<p class="msg-show"></p>
					</form>
				</div>
			</div>
		</div>
	</div>

