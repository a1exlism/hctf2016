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
				<div>
					<a>Challenges Solved</a>
				</div>

			</div>
		</div>
		<div class="col-md-offset-1 col-md-3 sidebar">
			<div class="row">
				<div id="team-ranking" class="col-md-offset-2 col-md-8">
					<a>Team Ranking</a>
					<div>
						<p class="team-ranking">Level: <span>10</span></p>
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
						<input type="button" class="btn" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>

