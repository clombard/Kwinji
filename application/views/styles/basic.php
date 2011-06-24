<h3>Text</h3>
<span class="subtitle">Sizes, alignments, styles,...</span>
<hr />
<h2>Heading H2</h2>
<h3>Heading H3</h3>
<h4>Heading H4</h4>
<h5>Heading H5</h5>
<p>&nbsp;</p>
<div class="colgroup leading">
  <div class="column width2 first">
    <div class="code">
      &lt;p <span>class="ta-left"</span>&gt;
    </div>
    <p class="ta-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et risus. Maecenas non nunc. Proin eleifend viverra sapien. Donec id augue. Duis erat nunc, volutpat a,
      bibendum quis, placerat vitae, enim. Etiam consectetur, velit in viverra tempus, urna augue sollicitudin tellus, vitae interdum arcu mi at est.</p>
  </div>
  <div class="column width2">
    <div class="code">
      &lt;p <span>class="ta-justify</span>"&gt;
    </div>
    <p class="ta-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et risus. Maecenas non nunc. Proin eleifend viverra sapien. Donec id augue. Duis erat nunc, volutpat a,
      bibendum quis, placerat vitae, enim. Etiam consectetur, velit in viverra tempus, urna augue sollicitudin tellus, vitae interdum arcu mi at est.</p>
  </div>
  <div class="column width2">
    <div class="code">
      &lt;p <span>class="ta-right"</span>&gt;
    </div>
    <p class="ta-right">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et risus. Maecenas non nunc. Proin eleifend viverra sapien. Donec id augue. Duis erat nunc, volutpat a,
      bibendum quis, placerat vitae, enim. Etiam consectetur, velit in viverra tempus, urna augue sollicitudin tellus, vitae interdum arcu mi at est.</p>
  </div>
</div>

<p>
  <strong>Lorem ipsum dolor sit amet</strong> <span class="code">&lt;strong&gt;</span>
</p>
<p>
  <em>Lorem ipsum dolor sit amet</em> <span class="code">&lt;em&gt;</span>
</p>
<p>
  <abbr title="Lorem ipsum dolor sit amet">Lorem ipsum dolor sit amet</abbr> <span class="code">&lt;abbr&gt;</span>
</p>
<p>
  <code>Lorem ipsum dolor sit amet</code>
  <span class="code">&lt;code&gt;</span>
</p>
<p>
  <small>Lorem ipsum dolor sit amet</small> <span class="code">&lt;small&gt;</span>
</p>
<p>
  <mark>Lorem ipsum dolor sit amet</mark>
  <span class="code">&lt;mark&gt;</span>
</p>
<p>
  <del>Lorem ipsum dolor sit amet</del>
  <span class="code">&lt;del&gt;</span>
</p>
<p>
  <a href="#" title="Lorem ipsum dolor sit amet">Lorem ipsum dolor sit amet</a> <span class="code">&lt;a&gt;</span>
</p>
<p>
  <q> A designer knows he has achieved perfection not when there is nothing left to add, but when there is nothing left to take away. <cite>Antoine De Saint-Exupery</cite> </q> <span class="code">&lt;q&gt;&lt;cite&gt;&lt;/cite&gt;&lt;/q&gt;</span>
</p>
<p>&nbsp;</p>

<div class="colgroup leading">
  <div class="column width2 first">
    <div class="code">&lt;ul&gt;&lt;li&gt;</div>
    <ul class="nostyle">
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet
        <ul>
          <li>Lorem ipsum dolor sit amet</li>
          <li>Lorem ipsum dolor sit amet</li>
          <li>Lorem ipsum dolor sit amet
            <ul>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
            </ul>
          </li>
          <li>Lorem ipsum dolor sit amet</li>
          <li>Lorem ipsum dolor sit amet</li>
        </ul>
      </li>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet</li>
    </ul>
  </div>
  <div class="column width2">
    <div class="code">&lt;ol&gt;&lt;li&gt;</div>
    <ol class="nostyle">
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet
        <ol>
          <li>Lorem ipsum dolor sit amet</li>
          <li>Lorem ipsum dolor sit amet</li>
          <li>Lorem ipsum dolor sit amet
            <ol>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
            </ol>
          </li>
          <li>Lorem ipsum dolor sit amet</li>
          <li>Lorem ipsum dolor sit amet</li>
        </ol>
      </li>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Lorem ipsum dolor sit amet</li>
    </ol>
  </div>
  <div class="column width2">
    <div class="code">&lt;dl&gt;&lt;dt&gt;&lt;dd&gt;</div>
    <dl>
      <dt>Lorem ipsum</dt>
      <dd>Lorem ipsum dolor sit amet.</dd>
      <dt>Lorem ipsum</dt>
      <dd>Lorem ipsum dolor sit amet.</dd>
      <dt>Lorem ipsum</dt>
      <dd>Lorem ipsum dolor sit amet.</dd>
    </dl>
  </div>
</div>

<h3>Progress bars</h3>
<span class="subtitle">Animated progress bars</span>
<hr />
<div class="leading">
  <div id="progress1" class="progress width2 progress-red">
    <span><b></b> </span>
  </div>
  <a href="#" onclick="Administry.progress('#progress1', 25, 100); return FALSE;">Set value to 25</a><br />
  <div id="progress2" class="progress width2 progress-blue">
    <span><b></b> </span>
  </div>
  <a href="#" onclick="Administry.progress('#progress2', 50, 100); return FALSE;">Set value to 50</a><br />
  <div id="progress3" class="progress width2 progress-green">
    <span><b></b> </span>
  </div>
  <a href="#" onclick="Administry.progress('#progress3', 100, 100); return FALSE;">Set value to 100</a><br />
</div>

Sample usage:
<br />
<div class="code">
  <pre>&lt;div <span>class="progress progress-blue"</span>&gt;
&lt;span&gt;&lt;b&gt;&lt;/b&gt;&lt;/span&gt;
&lt;/div&gt;

&lt;script&gt;Administry.progress('progress', 10, 100);&lt;/script&gt;</pre>
</div>

<h3>HTML5 Video</h3>
<span class="subtitle">Video support</span>
<hr />
<div id="video-flash">

<?php
// $Id$

$sources = array();
$sources[] = array(
  'src' => 'static/video/video.m4v',
  'type' => 'video/mp4',
);
$sources[] = array(
  'src' => 'static/video/video.ogg',
  'type' => 'static/video/ogg',
);
$sources[] = array(
  'src' => 'static/video/video.webm',
  'type' => 'video/webm; codecs="vorbis,vp8',
);
echo HTML::video(array('poster' => 'static/img/video-snapshot.jpg', 'controls' => 'TRUE', 'autoplay' => 'TRUE'), $sources);
?>

</div>
<p>
  More about &lt;video&gt; formats and browser supports at <a href="http://dev.opera.com/articles/view/opera-supports-webm-video/">http://dev.opera.com/articles/view/opera-supports-webm-video/</a>
</p>

<h3>Messages</h3>
<span class="subtitle">Info, warning, error and success boxes</span>
<hr />
<div class="box">Box sample</div>
<div class="box box-info">Info box sample</div>
<div class="box box-warning">Warning box sample</div>
<div class="box box-error">Error box sample</div>
<div class="box box-error-msg">
  <ol>
    <li>Credit card number entered is invalid</li>
    <li>Credit card verification number must be a valid number</li>
  </ol>
</div>
<div class="box box-success">Success box sample</div>
Sample usage:
<span class="code">&lt;div <span>class="box box-info"</span>&gt;Message&lt;/div&gt;</span>

<p>In case you want to make boxes closeable simply add the "closeable" class:</p>
<div class="box box-info closeable">This box can be closed!</div>
<span class="code">&lt;div <span>class="box box-info closeable"</span>&gt;Message&lt;/div&gt;</span>

<h3>Labels</h3>
<span class="subtitle">Identification labels</span>
<hr />

<span class="label label-red">Red</span>
<span class="label label-green">Green</span>
<span class="label label-blue">Blue</span>
<span class="label label-purple">Purple</span>
<span class="label label-gray">Gray</span>
<span class="label label-yellow">Yellow</span>
<span class="label label-gold">Gold</span>
<span class="label label-silver">Silver</span>
<span class="label label-black">Black</span>
<p>&nbsp;</p>
<p>
  Sample usage: <span class="code">&lt;span <span>class="label label-silver"</span>&gt;Message&lt;/span&gt;</span>
</p>

<h3>Buttons</h3>
<span class="subtitle">Sample buttons w/ or w/o icons</span>
<hr />
<a href="#" class="btn">Sample</a>
<a href="#" class="btn"><span class="icon icon-ok">&nbsp;</span>Ok</a>
<a href="#" class="btn"><span class="icon icon-cancel">&nbsp;</span>Cancel</a>
<a href="#" class="btn"><span class="icon icon-add">&nbsp;</span>Add New</a>
<p>&nbsp;</p>
<a href="#" class="btn btn-red">Red Button</a>
<a href="#" class="btn btn-green">Green Button</a>
<a href="#" class="btn btn-blue">Blue Button</a>
<p>&nbsp;</p>
Sample usage:
<span class="code">&lt;a href="#"<span> class="btn"</span>&gt;&lt;span <span>class="icon icon-ok"</span>&gt;&amp;nbsp;&lt;/span&gt;Button text&lt;/a&gt;</span>
<p>&nbsp;</p>

<h3>Tabs</h3>
<span class="subtitle">A set of containers</span>
<hr />
<div id="tabs">
  <ul>
    <li><a class="corner-tl" href="#tabs-1">Nunc tincidunt</a></li>
    <li><a class="" href="#tabs-2">Proin dolor</a></li>
    <li><a class="corner-tr" href="#tabs-3">Aenean lacinia</a></li>
  </ul>
  <div id="tabs-1">
    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem.
      Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam
      molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
  </div>
  <div id="tabs-2">
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus
      eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi
      facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere,
      felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
  </div>
  <div id="tabs-3">
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante.
      Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula
      tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit.
      Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut
      sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a
      libero vitae lectus hendrerit hendrerit.</p>
  </div>
</div>

<h3>Tables</h3>
<span class="subtitle">Arranging data into rows and columns of cells</span>
<hr />
<span class="code">&lt;table <span>class="stylized"</span>&gt;</span>
<table class="stylized full">
  <caption>Basic table (full width)</caption>
  <thead>
    <tr>
      <th>Header 1</th>
      <th>Header 2</th>
      <th>Header 3</th>
      <th>Header 4</th>
      <th>Header 5</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Data 1</td>
      <td>Data 2</td>
      <td>Data 3</td>
      <td>Data 4</td>
      <td>Data 5</td>
    </tr>
    <tr class="high">
      <td>Highlighted data 1</td>
      <td>Highlighted data 2</td>
      <td>Highlighted data 3</td>
      <td>Highlighted data 4</td>
      <td>Highlighted data 5</td>
    </tr>
    <tr>
      <td>Data 1</td>
      <td>Data 2</td>
      <td>Data 3</td>
      <td>Data 4</td>
      <td>Data 5</td>
    </tr>
    <tr>
      <td>Data 1</td>
      <td>Data 2</td>
      <td>Data 3</td>
      <td>Data 4</td>
      <td>Data 5</td>
    </tr>
    <tr>
      <td>Data 1</td>
      <td>Data 2</td>
      <td>Data 3</td>
      <td>Data 4</td>
      <td>Data 5</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="5">Table footer</td>
    </tr>
  </tfoot>
</table>

<span class="code">&lt;table <span>class="no-style"</span>&gt;</span>
<table class="no-style">
  <caption>No style applied</caption>
  <thead>
    <tr>
      <th>Header 1</th>
      <th>Header 2</th>
      <th>Header 3</th>
      <th>Header 4</th>
      <th>Header 5</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Data 1</td>
      <td>Data 2</td>
      <td>Data 3</td>
      <td>Data 4</td>
      <td>Data 5</td>
    </tr>
    <tr>
      <td>Data 1</td>
      <td>Data 2</td>
      <td>Data 3</td>
      <td>Data 4</td>
      <td>Data 5</td>
    </tr>
    <tr>
      <td>Data 1</td>
      <td>Data 2</td>
      <td>Data 3</td>
      <td>Data 4</td>
      <td>Data 5</td>
    </tr>
    <tr>
      <td>Data 1</td>
      <td>Data 2</td>
      <td>Data 3</td>
      <td>Data 4</td>
      <td>Data 5</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td>footer 1</td>
      <td>footer 2</td>
      <td>footer 3</td>
      <td>footer 4</td>
      <td>footer 5</td>
    </tr>
  </tfoot>
</table>
<p>
  To see the detailed presentation <a href="tables.html" title="Tables">click here</a>.
</p>

<h3>Content boxes</h3>
<span class="subtitle">Grouping various content</span>
<hr />

<div class="leading clearfix">
  <div class="column width3 first">

    <b>Status: opened</b>
    <div class="content-box corners">
      <header>
      <h3>
      <?php echo HTML::image('static/img/information.png', array('alt' => '')); ?>
        Nunc tincidunt
      </h3>
      </header>
      <section>
      <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et
        lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis
        aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
      <table class="no-style full">
        <tbody>
          <tr>
            <td><b>Users</b></td>
            <td class="ta-right">11</td>
          </tr>
          <tr>
            <td><b>Posts</b></td>
            <td class="ta-right">22</td>
          </tr>
          <tr>
            <td><b>Comments</b></td>
            <td class="ta-right">332</td>
          </tr>
        </tbody>
      </table>
      </section>
    </div>

  </div>

  <div class="column width3">

    <b>Status: closed</b>
    <div class="content-box corners content-box-closed">
      <header>
      <h3>
      <?php echo HTML::image('static/img/information.png', array('alt' => '')); ?>
        Proin dolor
      </h3>
      </header>
      <section>
      <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus
        eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam.</p>
      <table class="stylized">
        <caption>Table 1.</caption>
        <thead>
          <tr>
            <th>Header 1</th>
            <th>Header 2</th>
            <th>Header 3</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Data 1</td>
            <td>Data 2</td>
            <td>Data 3</td>
          </tr>
          <tr>
            <td>Data 1</td>
            <td>Data 2</td>
            <td>Data 3</td>
          </tr>
          <tr>
            <td>Data 1</td>
            <td>Data 2</td>
            <td>Data 3</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td>footer 1</td>
            <td>footer 2</td>
            <td>footer 3</td>
          </tr>
        </tfoot>
      </table>
      </section>
    </div>

  </div>

</div>


<h3>Popup boxes</h3>
<span class="subtitle">A quick way to show data without reloading the entire page</span>
<hr />

<p>
  <a href="#foobar" class="nyroModal" title="Inline Content Demo">Inline content (div#foobar)</a><br /> <a href="ajaxdemo.html" class="nyroModal" title="AJAX Content Demo">Remote content
    (ajaxdemo.html)</a> &middot; <a href="ajaxdemo.html" class="nyroModal" title="AJAX Content Demo" rev="modal">Remote modal content (ajaxdemo.html)</a><br /> <a
    href="http://www.youtube.com/watch?v=GgR6dyzkKHI" class="nyroModal" title="YouTube Video Demo">YouTube Video</a><br /> <a href="img/gallery/book01.jpg" class="nyroModal" title="Book" rel="gal">Gallery
    Img 1</a> &middot; <a href="img/gallery/card01.jpg" class="nyroModal" title="Card" rel="gal">Gallery Img 2</a> &middot; <a href="img/gallery/leaflet01.jpg" class="nyroModal" title="Leaflet"
    rel="gal">Gallery Img 3</a>
</p>
<p>
  For more detailed samples and demos visit <a href="http://nyromodal.nyrodev.com/">nyroModal homepage</a>.
</p>
<div id='foobar' style='display: none;'>This is an inline content</div>

<h3>Forms</h3>
<span class="subtitle">Selecting different kinds of user input</span>
<hr />

<p>
  To see the detailed presentation <a href="forms.html" title="Forms">click here</a>.
</p>

<p>&nbsp;</p>

