			<p class="leading">
				<?php echo HTML::anchor("ajax/form/add_company", HTML::image("static/img/add.png", array("class" => "icon")) . __("Add New Company"), array("class" => "btn btn-special btn-green nyroModal")); ?>
			</p>
			<div class="content-box corners content-box-closed">
				<header>
					<h3><?php echo HTML::image("static/img/information.png") . __("My Staff"); ?></h3>
				</header>
				<section>
					<table id="report" class="stylized half" style="">
						<tbody>
							<tr>
								<td class="title">
									<div>
										<a href="#"><b>John Doe</b></a>
										<div class="listingDetails">
											<div class="pad">
												<b>Additional information</b>
												<ul>
													<li><a href="http://en.wikipedia.org/wiki/Usa">USA on Wikipedia</a></li>
													<li><a  ef="http://nationalatlas.gov/">National Atlas of the United States</a></li>
													<li><a href="http://www.nationalcenter.org/HistoricalDocuments.html">Historical Documents</a></li>
												</ul>
											</div>
										</div>
									</div>
								</td>
								<td class="ta-right">14/12/1958</td>
							</tr>
							<tr>
								<td class="title">
									<div>
										<a href="#"><b>Bruce Baner</b></a>
										<div class="listingDetails" style="z-index:1">
											<div class="pad">
												<b>Additional information</b>
												<ul>
													<li><a href="http://en.wikipedia.org/wiki/United_kingdom">UK on Wikipedia</a></li>
													<li><a href="http://www.visitbritain.com/">Official tourist guide to Britain</a></li>
													<li><a href="http://www.statistics.gov.uk/StatBase/Product.asp?vlnk=5703">Official Yearbook of the United Kingdom</a></li>
												</ul>
											</div>
										</div>
									</div>
								</td>
								<td class="ta-right">17/04/1972</td>
							</tr>
							<tr>
								<td class="title">
									<div>
										<a href="#"><b>Mickael Jordan</b></a>
										<div class="listingDetails">
											<div class="pad">
												<b>Additional information</b>
												<ul>
													<li><a href="http://en.wikipedia.org/wiki/India">India on Wikipedia</a></li>
													<li><a href="http://india.gov.in/">Government of India</a></li>
													<li><a href="http://wikitravel.org/en/India">India travel guide</a></li>
												</ul>
											</div>
										</div>
									</div>
								</td>
								<td class="ta-right">24/11/1969</td>
							</tr>
						</tbody>
					</table>
				</section>
			</div>
			<div id="rightmenu">
				<header>
					<h3><?php echo __("Administration"); ?></h3>
				</header>
				<dl class="first">
					<dt><?php echo HTML::image("static/img/key.png");?></dt>
					<dd><?php echo HTML::anchor("#", __("Account acces"));?></dd>
					<dd class="last">Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus.</dd>
					
					<dt><?php echo HTML::image("static/img/delete.png");?></dt>
					<dd><?php echo HTML::anchor("#", __("Contacts manager"));?></dd>
					<dd class="last">Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc.</dd>
					
					<dt><?php echo HTML::image("static/img/add.png");?></dt>
					<dd><a href="#">Ajout d'administrateur</a></dd>
					<dd class="last">Ajoutez vos ressources pour leurs d�l�gu�s l'administration de votre portail.</dd>
				</dl>
			</div>
