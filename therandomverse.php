<?php
/*
Plugin Name: The Random Quranic Verse Widget
Plugin URI: http://iknowledge.islamicnature.com/extras.php
Description: A widget that displays a random Quranic verse
Author: Umar Sheikh
Author URI: http://www.indezinez.com
Version: 1.4
*/

add_action('widgets_init', 'load_random_verse');

function load_random_verse(){
  if(function_exists('register_widget')){
    register_widget('Random_Verse');
	}
}

class Random_Verse extends WP_Widget {

	function Random_Verse(){
	
		$widget_ops = array('classname' => 'randomverse', 'description' => __('A widget that displays a random Quranic Verse', 'randomverse'));
		$control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'random-verse');
		$this->WP_Widget('random-verse', __('Random Verse', 'randomverse'), $widget_ops, $control_ops);
	
	}

	function widget($args, $instance){
	
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$lang = $instance['lang'];
		echo $before_widget;
		if($title){
			echo $before_title.$title.$after_title;
		}
		if($lang){
      if(function_exists('file_get_contents')){
        if($file = @file_get_contents('http://iknowledge.islamicnature.com/rv_script.php?lang='.$lang)){
          $file = preg_replace('/document\.write\(\'(.*)\'\)\;/','$1',$file);
          echo '<p>'.str_replace("\'","'",$file).'</p>';
        }else{
          echo '
          <p>
          <script type="text/javascript" src="http://iknowledge.islamicnature.com/rv_script.php?lang='.$lang.'"></script>
          <noscript>Please enable javascript. <a href="http://iknowledge.islamicnature.com">iKnowledge</a></noscript>
          </p>
          ';
        }
      }else{
        echo '
        <p>
        <script type="text/javascript" src="http://iknowledge.islamicnature.com/rv_script.php?lang='.$lang.'"></script>
        <noscript>Please enable javascript. <a href="http://iknowledge.islamicnature.com">iKnowledge</a></noscript>
        </p>
        ';
      }
		}
		echo $after_widget;
		
	}

	function update($new_instance, $old_instance){
	
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['lang'] = $new_instance['lang'];
		return $instance;
		
	}

	function form($instance){

		$defaults = array('title' => __('Random Quranic Verse', 'randomverse'),'lang' => 'english');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Language: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e('Language:', 'randomverse'); ?></label> 
			<select id="<?php echo $this->get_field_id('lang'); ?>" name="<?php echo $this->get_field_name('lang'); ?>" class="widefat" style="width:100%;">
        <option value="english">Choose Language</option>
        <option value="albanianfeti" <?php if($instance['lang'] == 'albanianfeti'){ echo "selected='selected'"; }?>>Albanian: Feti Mehdiu</option>
        <option value="albanianhasan" <?php if($instance['lang'] == 'albanianhasan'){ echo "selected='selected'"; }?>>Albanian: Hasan Nahi</option>
        <option value="albaniansherif" <?php if($instance['lang'] == 'albaniansherif'){ echo "selected='selected'"; }?>>Albanian: Sherif Ahmeti</option>
        <option value="azerbaijan" <?php if($instance['lang'] == 'azerbaijan'){ echo "selected='selected'"; }?>>Azerbaijan</option>
        <option value="azerbaijanmusayev" <?php if($instance['lang'] == 'azerbaijanmusayev'){ echo "selected='selected'"; }?>>Azerbaijan: Musayev</option>
        <option value="bangla" <?php if($instance['lang'] == 'bangla'){ echo "selected='selected'"; }?>>Bangla</option>
        <option value="bosnian" <?php if($instance['lang'] == 'bosnian'){ echo "selected='selected'"; }?>>Bosnian</option>
        <option value="bosniankorkut" <?php if($instance['lang'] == 'bosniankorkut'){ echo "selected='selected'"; }?>>Bosnian: Korkut</option>
        <option value="bosnianmustafa" <?php if($instance['lang'] == 'bosnianmustafa'){ echo "selected='selected'"; }?>>Bosnian: Mustafa</option>
        <option value="bulgarian" <?php if($instance['lang'] == 'bulgarian'){ echo "selected='selected'"; }?>>Bulgarian</option>
        <option value="chinese" <?php if($instance['lang'] == 'chinese'){ echo "selected='selected'"; }?>>Chinese</option>
        <option value="chinesesimp" <?php if($instance['lang'] == 'chinesesimp'){ echo "selected='selected'"; }?>>Chinese: Simplified</option>
        <option value="czeckhrbek" <?php if($instance['lang'] == 'czeckhrbek'){ echo "selected='selected'"; }?>>Czeck: Hrbek</option>
        <option value="czecknykl" <?php if($instance['lang'] == 'czecknykl'){ echo "selected='selected'"; }?>>Czeck: Nykl</option>
        <option value="dutch" <?php if($instance['lang'] == 'dutch'){ echo "selected='selected'"; }?>>Dutch</option>
        <option value="dutchkeyzer" <?php if($instance['lang'] == 'dutchkeyzer'){ echo "selected='selected'"; }?>>Dutch: Keyzer</option>
        <option value="english" <?php if($instance['lang'] == 'english'){ echo "selected='selected'"; }?>>English</option>
        <option value="englishliteral" <?php if($instance['lang'] == 'englishliteral'){ echo "selected='selected'"; }?>>English: Literal</option>
        <option value="englishsahih" <?php if($instance['lang'] == 'englishsahih'){ echo "selected='selected'"; }?>>English: Sahih International</option>
        <option value="englishtran" <?php if($instance['lang'] == 'englishtran'){ echo "selected='selected'"; }?>>English: Transliteration</option>
        <option value="finnish" <?php if($instance['lang'] == 'finnish'){ echo "selected='selected'"; }?>>Finnish</option>
        <option value="french" <?php if($instance['lang'] == 'french'){ echo "selected='selected'"; }?>>French</option>
        <option value="frenchhamidullah" <?php if($instance['lang'] == 'frenchhamidullah'){ echo "selected='selected'"; }?>>French: Hamidullah</option>
        <option value="german" <?php if($instance['lang'] == 'german'){ echo "selected='selected'"; }?>>German</option>
        <option value="germanabubenheim" <?php if($instance['lang'] == 'germanabubenheim'){ echo "selected='selected'"; }?>>German: Bubenheim - Elyas</option>
        <option value="germanaburida" <?php if($instance['lang'] == 'germanaburida'){ echo "selected='selected'"; }?>>German: Abu-Rida Muhammad</option>
        <option value="germankhoury" <?php if($instance['lang'] == 'germankhoury'){ echo "selected='selected'"; }?>>German: Khoury</option>
        <option value="germanzaidan" <?php if($instance['lang'] == 'germanzaidan'){ echo "selected='selected'"; }?>>German: Zaidan</option>
        <option value="hausa" <?php if($instance['lang'] == 'hausa'){ echo "selected='selected'"; }?>>Hausa</option>
        <option value="indonesian" <?php if($instance['lang'] == 'indonesian'){ echo "selected='selected'"; }?>>Indonesian</option>
        <option value="indonesianbahasa" <?php if($instance['lang'] == 'indonesianbahasa'){ echo "selected='selected'"; }?>>Indonesian: Bahasa</option>
        <option value="italian" <?php if($instance['lang'] == 'italian'){ echo "selected='selected'"; }?>>Italian</option>
        <option value="italianpiccardo" <?php if($instance['lang'] == 'italianpiccardo'){ echo "selected='selected'"; }?>>Italian: Piccardo</option>
        <option value="japanese" <?php if($instance['lang'] == 'japanese'){ echo "selected='selected'"; }?>>Japanese</option>
        <option value="korean" <?php if($instance['lang'] == 'korean'){ echo "selected='selected'"; }?>>Korean</option>
        <option value="kurdi" <?php if($instance['lang'] == 'kurdi'){ echo "selected='selected'"; }?>>Kurdi</option>
        <option value="latin" <?php if($instance['lang'] == 'latin'){ echo "selected='selected'"; }?>>Latin</option>
        <option value="malayalam" <?php if($instance['lang'] == 'malayalam'){ echo "selected='selected'"; }?>>Malayalam</option>
        <option value="malaysian" <?php if($instance['lang'] == 'malaysian'){ echo "selected='selected'"; }?>>Malaysian</option>
        <option value="maranao" <?php if($instance['lang'] == 'maranao'){ echo "selected='selected'"; }?>>Maranao</option>
        <option value="mexican" <?php if($instance['lang'] == 'mexican'){ echo "selected='selected'"; }?>>Mexican</option>
        <option value="norwegianeinar" <?php if($instance['lang'] == 'norwegianeinar'){ echo "selected='selected'"; }?>>Norwegian: Einar Berg</option>
        <option value="persian" <?php if($instance['lang'] == 'persian'){ echo "selected='selected'"; }?>>Persian</option>
        <option value="persianalha" <?php if($instance['lang'] == 'persianalha'){ echo "selected='selected'"; }?>>Persian: &#1575;&#1604;&#1607;&#1740; &#1602;&#1605;&#1588;&#1607;&#8204; &#1575;&#1740;</option>
        <option value="persianhasin" <?php if($instance['lang'] == 'persianhasin'){ echo "selected='selected'"; }?>>Persian: &#1581;&#1587;&#1740;&#1606; &#1575;&#1606;&#1589;&#1575;&#1585;&#1740;&#1575;&#1606;</option>
        <option value="persianmekaram" <?php if($instance['lang'] == 'persianmekaram'){ echo "selected='selected'"; }?>>Persian: &#1605;&#1705;&#1575;&#1585;&#1605; &#1588;&#1740;&#1585;&#1575;&#1586;&#1740;</option>
        <option value="polish" <?php if($instance['lang'] == 'polish'){ echo "selected='selected'"; }?>>Polish</option>
        <option value="polishbielawskiego" <?php if($instance['lang'] == 'polishbielawskiego'){ echo "selected='selected'"; }?>>Polish: Bielawskiego</option>
        <option value="portuguese" <?php if($instance['lang'] == 'portuguese'){ echo "selected='selected'"; }?>>Portuguese</option>
        <option value="portugueseelhayek" <?php if($instance['lang'] == 'portugueseelhayek'){ echo "selected='selected'"; }?>>Portuguese: El-Hayek</option>
        <option value="romanian" <?php if($instance['lang'] == 'romanian'){ echo "selected='selected'"; }?>>Romanian</option>
        <option value="romaniangeorge" <?php if($instance['lang'] == 'romaniangeorge'){ echo "selected='selected'"; }?>>Romanian: George Grigore</option>
        <option value="russian" <?php if($instance['lang'] == 'russian'){ echo "selected='selected'"; }?>>Russian</option>
        <option value="russianone" <?php if($instance['lang'] == 'russianone'){ echo "selected='selected'"; }?>>Russian: &#1069;&#1083;&#1100;&#1084;&#1080;&#1088; &#1050;&#1091;&#1083;&#1080;&#1077;&#1074;</option>
        <option value="russianthree" <?php if($instance['lang'] == 'russianthree'){ echo "selected='selected'"; }?>>Russian: &#1042;&#1072;&#1083;&#1077;&#1088;&#1080;&#1103; &#1055;&#1086;&#1088;&#1086;&#1093;&#1086;&#1074;&#1072;</option>
        <option value="russiantwo" <?php if($instance['lang'] == 'russiantwo'){ echo "selected='selected'"; }?>>Russian: &#1052;.-&#1053;.&#1054;. &#1054;&#1089;&#1084;&#1072;&#1085;&#1086;&#1074;</option>
        <option value="somalialbarwani" <?php if($instance['lang'] == 'somalialbarwani'){ echo "selected='selected'"; }?>>Somali: Al-Barwani</option>
        <option value="spanish" <?php if($instance['lang'] == 'spanish'){ echo "selected='selected'"; }?>>Spanish</option>
        <option value="spanishcortes" <?php if($instance['lang'] == 'spanishcortes'){ echo "selected='selected'"; }?>>Spanish: Cortes</option>
        <option value="swahili" <?php if($instance['lang'] == 'swahili'){ echo "selected='selected'"; }?>>Swahili</option>
        <option value="swedishrashad" <?php if($instance['lang'] == 'swedishrashad'){ echo "selected='selected'"; }?>>Swedish: Rashad Kalifa</option>
        <option value="tamil" <?php if($instance['lang'] == 'tamil'){ echo "selected='selected'"; }?>>Tamil</option>
        <option value="tatar" <?php if($instance['lang'] == 'tatar'){ echo "selected='selected'"; }?>>Tatar</option>
        <option value="thai" <?php if($instance['lang'] == 'thai'){ echo "selected='selected'"; }?>>Thai</option>
        <option value="turkish" <?php if($instance['lang'] == 'turkish'){ echo "selected='selected'"; }?>>Turkish</option>
        <option value="turkishalibulac" <?php if($instance['lang'] == 'turkishalibulac'){ echo "selected='selected'"; }?>><?php echo htmlentities('Turkish: Ali Bulaç'); ?></option>
        <option value="turkishelmalili" <?php if($instance['lang'] == 'turkishelmalili'){ echo "selected='selected'"; }?>>Turkish: Elmal&#305;l&#305; Hamdi Yaz&#305;r</option>
        <option value="turkishiskender" <?php if($instance['lang'] == 'turkishiskender'){ echo "selected='selected'"; }?>>Turkish: &#304;skender Ali Mihr</option>
        <option value="turkishmuhammed" <?php if($instance['lang'] == 'turkishmuhammed'){ echo "selected='selected'"; }?>>Turkish: Muhammed Esed</option>
        <option value="turkishyasar" <?php if($instance['lang'] == 'turkishyasar'){ echo "selected='selected'"; }?>>Turkish: Ya&#351;ar Nuri <?php echo htmlentities('Öztürk'); ?></option>
        <option value="urduahmed" <?php if($instance['lang'] == 'urduahmed'){ echo "selected='selected'"; }?>>Urdu: &#1575;&#1581;&#1605;&#1583; &#1585;&#1590;&#1575; &#1582;&#1575;&#1606;</option>
        <option value="urdujalandhry" <?php if($instance['lang'] == 'urdujalandhry'){ echo "selected='selected'"; }?>>Urdu: &#1580;&#1575;&#1604;&#1606;&#1583;&#1729;&#1585;&#1740;</option>
        <option value="uzbek" <?php if($instance['lang'] == 'uzbek'){ echo "selected='selected'"; }?>>Uzbek: &#1052;&#1091;&#1093;&#1072;&#1084;&#1084;&#1072;&#1076; &#1057;&#1086;&#1076;&#1080;&#1082;</option>
			</select>
		</p>

	<?php
	}
}

?>