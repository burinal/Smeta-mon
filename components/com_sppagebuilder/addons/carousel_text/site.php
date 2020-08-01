<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2019 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonCarousel_text extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? ' ' . $settings->class : '';

		//Addons option
		$autoplay = (isset($settings->autoplay) && $settings->autoplay) ? 1 : 0;
		$controllers = (isset($settings->controllers) && $settings->controllers) ? $settings->controllers : 0;
		$arrows = (isset($settings->arrows) && $settings->arrows) ? $settings->arrows : 0;
		$alignment = (isset($settings->alignment) && $settings->alignment) ? $settings->alignment : 0;
		$interval = (isset($settings->interval) && $settings->interval) ? ((int) $settings->interval * 1000) : 5000;
		$carousel_autoplay = ($autoplay) ? ' data-sppb-ride="sppb-carousel"':'';
        if($autoplay == 0) {
            $interval = 'false';
        }
		$output  = '<div class="photos_slider">';
        if($controllers) {
            $output .= '<ul>';
            foreach ($settings->sp_carousel_item as $key1 => $value) {
                $alt_text = isset($value->title) ? $value->title : '';
                $output .= '<li data-sppb-target="#sppb-carousel-'. $this->addon->id .'" '. (($key1 == 0) ? ' class="visible"': '' ) .'  data-sppb-slide-to="'. $key1 .'"><img src="' . $value->bg . '" alt="'.$alt_text.'"></li>';
            }
            $output .= '</ul>';
        }
        $output  .='</div>';
        $output .= '<div class="description">';
        if($controllers) {
            $output .= '<h1>О компании</h1>';
            $output .= '<ul class="text_slider">';
            foreach ($settings->sp_carousel_item as $key1 => $value) {
                $output .= '<li '. (($key1 == 0) ? ' class="visible"': '' ) .'  data-sppb-slide-to="'. $key1 .'">' . $value->content . '</li>';
            }
            $output .= '</ul>';
            $output .= '<ul class="switch">';
            foreach ($settings->sp_carousel_item as $key1 => $value) {
                $output .= '<li  data-frame="'.$key1.'"></li>';
            }
            $output .= '</ul>';
        }
        $output .= '</div>';
		return $output;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$css = '';
		$speed = (isset($this->addon->settings->speed) && $this->addon->settings->speed) ? $this->addon->settings->speed : 600;

		$css .= $addon_id.' .sppb-carousel-inner > .sppb-item{-webkit-transition-duration: '.$speed.'ms; transition-duration: '.$speed.'ms;}';

		return $css;
	}

	public static function getTemplate(){
		$output = '
		<#
		var interval = data.interval ? parseInt(data.interval) * 1000 : 5000;
		if(data.autoplay==0){
			interval = "false";
		}
		var autoplay = data.autoplay ? \'data-sppb-ride="sppb-carousel"\' : "";
		#>
		<style type="text/css">
			#sppb-addon-{{ data.id }} .sppb-carousel-inner > .sppb-item{
				-webkit-transition-duration: {{ data.speed }}ms;
				transition-duration: {{ data.speed }}ms;
			}
			<# _.each(data.sp_carousel_item, function (carousel_item, key){ #>
				<# var button_fontstyle = carousel_item.button_fontstyle || ""; #>
				#sppb-addon-{{ data.id }} #btn-{{ data.id + "" + key }}.sppb-btn-{{ carousel_item.type }}{
					letter-spacing: {{ carousel_item.button_letterspace }};
					<# if(_.isArray(button_fontstyle)) { #>
						<# if(button_fontstyle.indexOf("underline") !== -1){ #>
							text-decoration: underline;
						<# } #>
						<# if(button_fontstyle.indexOf("uppercase") !== -1){ #>
							text-transform: uppercase;
						<# } #>
						<# if(button_fontstyle.indexOf("italic") !== -1){ #>
							font-style: italic;
						<# } #>
						<# if(button_fontstyle.indexOf("lighter") !== -1){ #>
							font-weight: lighter;
						<# } else if(button_fontstyle.indexOf("normal") !== -1){#>
							font-weight: normal;
						<# } else if(button_fontstyle.indexOf("bold") !== -1){#>
							font-weight: bold;
						<# } else if(button_fontstyle.indexOf("bolder") !== -1){#>
							font-weight: bolder;
						<# } #>
					<# } #>
				}

				<# if(carousel_item.button_type == "custom"){ #>
					#sppb-addon-{{ data.id }} #btn-{{ data.id + "" + key }}.sppb-btn-custom{
						color: {{ carousel_item.button_color }};
						<# if(carousel_item.button_appearance == "outline"){ #>
							border-color: {{ carousel_item.button_background_color }}
						<# } else if(carousel_item.button_appearance == "3d"){ #>
							border-bottom-color: {{ carousel_item.button_background_color_hover }};
							background-color: {{ carousel_item.button_background_color }};
						<# } else if(carousel_item.button_appearance == "gradient"){ #>
							border: none;
							<# if(typeof carousel_item.button_background_gradient.type !== "undefined" && carousel_item.button_background_gradient.type == "radial"){ #>
								background-image: radial-gradient(at {{ carousel_item.button_background_gradient.radialPos || "center center"}}, {{ carousel_item.button_background_gradient.color }} {{ carousel_item.button_background_gradient.pos || 0 }}%, {{ carousel_item.button_background_gradient.color2 }} {{ carousel_item.button_background_gradient.pos2 || 100 }}%);
							<# } else { #>
								background-image: linear-gradient({{ carousel_item.button_background_gradient.deg || 0}}deg, {{ carousel_item.button_background_gradient.color }} {{ carousel_item.button_background_gradient.pos || 0 }}%, {{ carousel_item.button_background_gradient.color2 }} {{ carousel_item.button_background_gradient.pos2 || 100 }}%);
							<# } #>
						<# } else { #>
							background-color: {{ carousel_item.button_background_color }};
						<# } #>
					}

					#sppb-addon-{{ data.id }} #btn-{{ data.id + "" + key }}.sppb-btn-custom:hover{
						color: {{ carousel_item.button_color_hover }};
						background-color: {{ carousel_item.button_background_color_hover }};
						<# if(carousel_item.button_appearance == "outline"){ #>
							border-color: {{ carousel_item.button_background_color_hover }};
						<# } else if(carousel_item.button_appearance == "gradient"){ #>
							<# if(typeof carousel_item.button_background_gradient_hover.type !== "undefined" && carousel_item.button_background_gradient_hover.type == "radial"){ #>
								background-image: radial-gradient(at {{ carousel_item.button_background_gradient_hover.radialPos || "center center"}}, {{ carousel_item.button_background_gradient_hover.color }} {{ carousel_item.button_background_gradient_hover.pos || 0 }}%, {{ carousel_item.button_background_gradient_hover.color2 }} {{ carousel_item.button_background_gradient_hover.pos2 || 100 }}%);
							<# } else { #>
								background-image: linear-gradient({{ carousel_item.button_background_gradient_hover.deg || 0}}deg, {{ carousel_item.button_background_gradient_hover.color }} {{ carousel_item.button_background_gradient_hover.pos || 0 }}%, {{ carousel_item.button_background_gradient_hover.color2 }} {{ carousel_item.button_background_gradient_hover.pos2 || 100 }}%);
							<# } #>
						<# } #>
					}

				<# } #>
				<#
					var padding = "";
					var padding_sm = "";
					var padding_xs = "";
					if(carousel_item.title_padding){
						if(_.isObject(carousel_item.title_padding)){
							if(carousel_item.title_padding.md.trim() !== ""){
								padding = carousel_item.title_padding.md.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}

							if(carousel_item.title_padding.sm.trim() !== ""){
								padding_sm = carousel_item.title_padding.sm.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}

							if(carousel_item.title_padding.xs.trim() !== ""){
								padding_xs = carousel_item.title_padding.xs.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}
						}

					}

					var margin = "";
					var margin_sm = "";
					var margin_xs = "";
					if(carousel_item.title_margin){
						if(_.isObject(carousel_item.title_margin)){
							if(carousel_item.title_margin.md.trim() !== ""){
								margin = carousel_item.title_margin.md.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}

							if(carousel_item.title_margin.sm.trim() !== ""){
								margin_sm = carousel_item.title_margin.sm.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}

							if(carousel_item.title_margin.xs.trim() !== ""){
								margin_xs = carousel_item.title_margin.xs.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}
						}

					}


					var content_padding = "";
					var content_padding_sm = "";
					var content_padding_xs = "";
					if(carousel_item.content_padding){
						if(_.isObject(carousel_item.content_padding)){
							if(carousel_item.content_padding.md.trim() !== ""){
								content_padding = carousel_item.content_padding.md.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}

							if(carousel_item.content_padding.sm.trim() !== ""){
								content_padding_sm = carousel_item.content_padding.sm.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}

							if(carousel_item.content_padding.xs.trim() !== ""){
								content_padding_xs = carousel_item.content_padding.xs.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}
						}

					}

					var content_margin = "";
					var content_margin_sm = "";
					var content_margin_xs = "";
					if(carousel_item.content_margin){
						if(_.isObject(carousel_item.content_margin)){
							if(carousel_item.content_margin.md.trim() !== ""){
								content_margin = carousel_item.content_margin.md.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}

							if(carousel_item.content_margin.sm.trim() !== ""){
								content_margin_sm = carousel_item.content_margin.sm.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}

							if(carousel_item.content_margin.xs.trim() !== ""){
								content_margin_xs = carousel_item.content_margin.xs.split(" ").map(item => {
									if(_.isEmpty(item)){
										return "0";
									}
									return item;
								}).join(" ")
							}
						}

					}
				#>

				#sppb-addon-{{ data.id }} .sppb-item-{{ data.id }}{{ key }} .sppb-carousel-caption h2{
					<# if(_.isObject(carousel_item.title_fontsize)){ #>
						font-size: {{ carousel_item.title_fontsize.md }}px;
					<# } else { #>
						font-size: {{ carousel_item.title_fontsize }}px;
					<# } #>
					<# if(_.isObject(carousel_item.title_lineheight)){ #>
						line-height: {{ carousel_item.title_lineheight.md }}px;
					<# } else { #>
						line-height: {{ carousel_item.title_lineheight }}px;
					<# } #>
					color: {{ carousel_item.title_color }};
					padding: {{ padding }};
					margin: {{ margin }};
				}
				#sppb-addon-{{ data.id }} .sppb-item-{{ data.id }}{{ key }} .sppb-carousel-caption .sppb-carousel-content{
					<# if(_.isObject(carousel_item.content_fontsize)){ #>
						font-size: {{ carousel_item.content_fontsize.md }}px;
					<# } else { #>
						font-size: {{ carousel_item.content_fontsize }}px;
					<# } #>
					<# if(_.isObject(carousel_item.content_lineheight)){ #>
						line-height: {{ carousel_item.content_lineheight.md }}px;
					<# } else { #>
						line-height: {{ carousel_item.content_lineheight }}px;
					<# } #>
					color: {{ carousel_item.content_color }};
					padding: {{ content_padding }};
					margin: {{ content_margin }};
				}
				@media (min-width: 768px) and (max-width: 991px) {
					#sppb-addon-{{ data.id }} .sppb-item-{{ data.id }}{{ key }} .sppb-carousel-caption h2{
						<# if(_.isObject(carousel_item.title_fontsize)){ #>
							font-size: {{ carousel_item.title_fontsize.sm }}px;
						<# } #>
						<# if(_.isObject(carousel_item.title_lineheight)){ #>
							line-height: {{ carousel_item.title_lineheight.sm }}px;
						<# } #>
						padding: {{ padding_sm }};
						margin: {{ margin_sm }};
					}
					#sppb-addon-{{ data.id }} .sppb-item-{{ data.id }}{{ key }} .sppb-carousel-caption .sppb-carousel-content{
						<# if(_.isObject(carousel_item.content_fontsize)){ #>
							font-size: {{ carousel_item.content_fontsize.sm }}px;
						<# } #>
						<# if(_.isObject(carousel_item.content_lineheight)){ #>
							line-height: {{ carousel_item.content_lineheight.sm }}px;
						<# } #>
						padding: {{ content_padding_sm }};
						margin: {{ content_margin_sm }};
					}
				}

				@media (max-width: 767px) {
					#sppb-addon-{{ data.id }} .sppb-item-{{ data.id }}{{ key }} .sppb-carousel-caption h2{
						<# if(_.isObject(carousel_item.title_fontsize)){ #>
							font-size: {{ carousel_item.title_fontsize.xs }}px;
						<# } #>
						<# if(_.isObject(carousel_item.title_lineheight)){ #>
							line-height: {{ carousel_item.title_lineheight.xs }}px;
						<# } #>
						padding: {{ padding_xs }};
						margin: {{ margin_xs }};
					}
					#sppb-addon-{{ data.id }} .sppb-item-{{ data.id }}{{ key }} .sppb-carousel-caption .sppb-carousel-content{
						<# if(_.isObject(carousel_item.content_fontsize)){ #>
							font-size: {{ carousel_item.content_fontsize.xs }}px;
						<# } #>
						<# if(_.isObject(carousel_item.content_lineheight)){ #>
							line-height: {{ carousel_item.content_lineheight.xs }}px;
						<# } #>
						padding: {{ content_padding_xs }};
						margin: {{ content_margin_xs }};
					}
				}
			<# }); #>
		</style>
		<div class="sppb-carousel sppb-slide {{ data.class }}" id="sppb-carousel-{{ data.id }}" data-interval="{{ interval }}" {{{ autoplay }}}>
			<# if(data.controllers){ #>
				<ol class="sppb-carousel-indicators">
				<# _.each(data.sp_carousel_item, function (carousel_item, key){ #>
					<# var active = (key == 0) ? "active" : ""; #>
					<li data-sppb-target="#sppb-carousel-{{ data.id }}"  class="{{ active }}"  data-sppb-slide-to="{{ key }}"></li>
				<# }); #>
				</ol>
			<# } #>
			<div class="sppb-carousel-inner {{ data.alignment }}">
				<# _.each(data.sp_carousel_item, function (carousel_item, key){ #>
					<#
						var classNames = (key == 0) ? "active" : "";
						classNames += (carousel_item.bg) ? " sppb-item-has-bg" : "";
						classNames += " sppb-item-"+data.id+""+key;
					#>
					<div class="sppb-item {{ classNames }}">
						<# if(carousel_item.bg && carousel_item.bg.indexOf("http://") == -1 && carousel_item.bg.indexOf("https://") == -1){ #>
							<img src=\'{{ pagebuilder_base + carousel_item.bg }}\' alt="{{ carousel_item.title }}">
						<# } else if(carousel_item.bg){ #>
							<img src=\'{{ carousel_item.bg }}\' alt="{{ carousel_item.title }}">
						<# } #>
						<div class="sppb-carousel-item-inner">
							<div class="sppb-carousel-caption">
								<div class="sppb-carousel-text">
									<# if(carousel_item.title || carousel_item.content) { #>
										<# if(carousel_item.title) { #>
											<h2 class="sp-editable-content" id="addon-title-{{data.id}}-{{key}}" data-id={{data.id}} data-fieldName="sp_carousel_item-{{key}}-title">{{ carousel_item.title }}</h2>
										<# } #>
										<div class="sppb-carousel-content sp-editable-content" id="addon-content-{{data.id}}-{{key}}" data-id={{data.id}} data-fieldName="sp_carousel_item-{{key}}-content">{{{ carousel_item.content }}}</div>
										<# if(carousel_item.button_text) { #>
											<#
												var btnClass = "";
												btnClass += carousel_item.button_type ? " sppb-btn-"+carousel_item.button_type : " sppb-btn-default" ;
												btnClass += carousel_item.button_size ? " sppb-btn-"+carousel_item.button_size : "" ;
												btnClass += carousel_item.button_shape ? " sppb-btn-"+carousel_item.button_shape : " sppb-btn-rounded" ;
												btnClass += carousel_item.button_appearance ? " sppb-btn-"+carousel_item.button_appearance : "" ;
												btnClass += carousel_item.button_block ? " "+carousel_item.button_block : "" ;
												var button_text = carousel_item.button_text;

												if(carousel_item.button_icon_position == "left"){
													button_text = (carousel_item.button_icon) ? \'<i class="fa  \'+carousel_item.button_icon+\'"></i> \'+carousel_item.button_text : carousel_item.button_text ;
												}else{
													button_text = (carousel_item.button_icon) ? carousel_item.button_text+\' <i class="fa \'+carousel_item.button_icon+\'"></i>\' : carousel_item.button_text ;
												}
											#>
											<a href=\'{{ carousel_item.button_url }}\' target="{{ carousel_item.button_target }}" id="btn-{{ data.id + "" + key}}" class="sppb-btn{{ btnClass }}">{{{ button_text }}}</a>
										<# } #>
									<# } #>
								</div>
							</div>
						</div>
					</div>
				<# }); #>
			</div>
			<# if(data.arrows) { #>
				<a href="#sppb-carousel-{{ data.id }}" class="sppb-carousel-arrow left sppb-carousel-control" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
				<a href="#sppb-carousel-{{ data.id }}" class="sppb-carousel-arrow right sppb-carousel-control" data-slide="next"><i class="fa fa-chevron-right"></i></a>
			<# } #>
		</div>
		';

		return $output;
	}
}