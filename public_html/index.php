<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 10/12/2016
 * Time: 11:00 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/main.css" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">

		<title>Data Design for Wanikani Radicals</title>
	</head>
	<body>
		<!-- the header -->
		<header>
			<div class="header-main-text">
				<h1>Data Design</h1>
			</div>
			<div class="header-sub-text">
				<h4>For Wanikani profile and radicals</h4>
			</div>
		</header>
		<!--main content-->
		<main>
			<!--begin section 1 (persona section)-->
			<section>
				<h2>Persona</h2>
				<details>
					<summary></summary>
					<h3>John Meerschwein</h3>
					<p><strong>Age: </strong>24</p>
					<p><strong>Profession:  </strong>English teacher in Japan. Teaches at an afterschool "cram school" program.</p>
					<p><strong>Technology: </strong>Reasonably proficient with Windows and web browsers (chrome and firefox). Doen't really use is phone for studying</p>
					<p><strong>Education: </strong>Has a B.A. in English. Does not know much Japanese.</p>
					<p><strong>Attitudes and Behaviors: </strong>Not incredibly motivated to study. After work John likes to play video games and finds it hard to set aside much time for anything else.</p>
					<p><strong>Needs: </strong>John needs a simple method for studying Japanese that requires the minimal amount of effort on his part, but still provides results.</p>
					<p><strong>Goal: </strong>To increase his ability to read kanji, specifically by looking at their radicals, and increase his vocabulary size in Japanese.</p>
					<h3>Summary</h3>
					<ul>
						<li>John Meerschwein</li>
						<li>Male</li>
						<li>24 years old</li>
						<li>English teacher in Japan</li>
						<li>B.A. English</li>
						<li>Doesn't know much Japanese</li>
						<li>not great at studying</li>
						<li>Proficient with windows and generic web browsers</li>
						<li>needs something that makes studying simple</li>
						<li>Wants to increase his reading ability in Japanese</li>
					</ul>
				</details>
			</section>
			<section>
				<h2>Use Case and Interaction Flow</h2>
				<details>
					<summary></summary>
					<h3>Use Case</h3>
					<p>John Meerschwein just got home from work. He's exhausted and slightly annoyed from working with children all evening, he just wants to relax. However, John is also annoyed that he got lost on his way home again due to his inability to read Kanji. John decides enough is enough, he needs to learn Kanji. Being about as motivated to do anything as John ever has been in his whole life, he searches for "Learn kanji easily" on his PC. He finds wanikani, which starts creates and manages flash cards for you, starting with kanji radicals.</p>
					<h3>Interaction Flow</h3>
					<ol>
						<li>John creates an account and logs in on his favorite web browser on his PC</li>
						<li>John clicks on the "lessons" button and reads through the new items he needs to memorize</li>
						<li>John takes the quiz for the items he just read through</li>
						<li>John logs out for the night</li>
						<li>The next day after work, John logs back in an reviews the items he learned yesterday</li>
						<li>John logs out again for the night</li>
					</ol>
				</details>
			</section>
			<section>
				<h2>Entities and Attributes</h2>
				<details>
					<summary></summary>
					<ul>
						<li>Radicals</li>
						<details>
							<summary>Attributes</summary>
							<ul>
								<li>radicalId</li>
								<li>radicalLevel</li>
								<li>lockedStatus</li>
								<li>burnStatus</li>
								<li>percentCorrect</li>
							</ul>
						</details>
					</ul>
					<ul>
						<li>Profile</li>
						<details>
							<summary>Attributes</summary>
							<ul>
								<li>userId</li>
								<li>userName</li>
								<li>userLevel</li>
							</ul>
						</details>
					</ul>
				</details>
			</section>
		</main>
	</body>
</html>
