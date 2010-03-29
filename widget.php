<div id="groupon_widget" <?php if(get_option("grpn_wdgt_rounded")) echo 'class="rounded_on"'; ?>>
    <h1>Daily Deal in <span><?= $deal->division_name; ?></span></h1>
    <div id="groupon_box" <?php if(get_option("grpn_wdgt_rounded")) echo 'class="rounded_on"'; ?>>
      <h2><a href="" class="groupon_widget_text_link"><?= $deal->title; ?></a></h2>
      <div id="left">
        <div id="price_tag_wrap">
          <div id="triangle">
          	<div id="hole"><img src="<?php echo WP_PLUGIN_URL; ?>/groupon-widget/images/hole.png"/></div>
          </div>
          <div id="price_tag">
            <h2><?= groupon_format_price($deal->price); ?></h2>
          </div>
        </div>
        <table id="breakdown">
          <tr>
            <th class="groupon_widget_text">value</th>
            <th class="groupon_widget_text">discount</th>
            <th class="groupon_widget_text">save</th>
          </tr>
          <tr>
            <td class="groupon_widget_text bold"><?= groupon_format_price($deal->value); ?></td>
            <td class="groupon_widget_text bold"><?= $deal->discount_percent; ?>%</td>
            <td class="groupon_widget_text bold"><?= groupon_format_price($deal->discount_amount); ?></td>
          </tr>
        </table>
        <table id="number_bought" class="bold">
          <tr>
            <td class="groupon_widget_text" id="number"><?= $deal->quantity_sold; ?></td>
          </tr>
          <tr>
            <td class="groupon_widget_text">bought</td>
          </tr>
        </table>
        <table id="time_left_label" style="display:none;">
          <tr colspan="4">
            <td class="groupon_widget_text">time left to buy</td>
          </tr>
        </table>
        <table id="time_left" class="bold">
          <tr>
            <td class="groupon_widget_text number" id="grpn_days_remaining"><?= $time_left["days"]; ?></td>
            <td class="groupon_widget_text number" id="grpn_hours_remaining"><?= $time_left["hours"]; ?></td>
            <td class="groupon_widget_text number" id="grpn_minutes_remaining"><?= $time_left["minutes"]; ?></td>
            <td class="groupon_widget_text number" id="grpn_seconds_remaining"><?= $time_left["seconds"]; ?></td>
          </tr>
          <tr>
            <td class="groupon_widget_text label">D</td>
            <td class="groupon_widget_text label">H</td>
            <td class="groupon_widget_text label">M</td>
            <td class="groupon_widget_text label">S</td>
          </tr>
        </table>
      </div>

      <div id="right">
        <p id="deal_image">
          <a href="<?= $deal->deal_url; ?>">
          <img src="<?= $deal->large_image_url; ?>" alt="<?= $deal->title; ?>"/>
          </a>
        </p>
          
        <div id="get_it" class="get_it_rounded">
          <a href="">GET IT!</a>
        </div>
      </div>
    </div>
  <div id="grpn_wdgt_footer">
    <a class="rounded_on groupon_widget_text_link" href="">Get this widget, get money!</a>
  </div>
  <script type="text/javascript">
    GRPN.currentWidgetCountdown = new GRPN.countdown({targetDate: <?php echo strtotime($deal->end_date) * 1000; ?>}).start();
  </script>
</div>