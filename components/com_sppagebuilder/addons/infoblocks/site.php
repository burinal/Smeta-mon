<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonInfoblocks extends SppagebuilderAddons{

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
		$item_alignment = (isset($this->addon->settings->item_alignment) && $this->addon->settings->item_alignment) ? $this->addon->settings->item_alignment : '';

		$output  = '<div class="our_benefits">';
		$output .= '<ul>';
		if(isset($this->addon->settings->sp_infoblocks_item) && count((array) $this->addon->settings->sp_infoblocks_item)){
			foreach ($this->addon->settings->sp_infoblocks_item as $key => $value) {
				if($value->thumb) {
					$output .= '<li>';
					$output .= '<img src="' . $value->thumb . '" alt="' . $value->title . '">' . $value->title . '';
					$output .= '</li>';
				}
			}
		}

		$output .= '</ul>';
		$output	.= '</div>';

		return $output;
	}

	public static function getTemplate() {
		$output = '
		<style type="text/css">
            #sppb-addon-{{ data.id }} .sppb-gallery img {
                <# if(_.isObject(data.width)){ #>
                    width: {{data.width.md}}px;
                <# } else { #>
                    width: {{data.width}}px;
                <# } #>
                <# if(_.isObject(data.height)){ #>
                    height: {{data.height.md}}px;
                <# } else { #>
                    height: {{data.height}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .sppb-gallery li {
                <# if(_.isObject(data.item_gap)){ #>
                    margin: {{data.item_gap.md}}px;
                <# } else { #>
                    margin: {{data.item_gap}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .sppb-gallery {
                <# if(_.isObject(data.item_gap)){ #>
                    margin: -{{data.item_gap.md}}px;
                <# } else { #>
                    margin: -{{data.item_gap}}px;
                <# } #>
            }
            @media (min-width: 768px) and (max-width: 991px) {
                #sppb-addon-{{ data.id }} .sppb-gallery img {
                    <# if(_.isObject(data.width)){ #>
                        width: {{data.width.sm}}px;
                    <# } #>
                    <# if(_.isObject(data.height)){ #>
                        height: {{data.height.sm}}px;
                    <# } #>
                }
                
                #sppb-addon-{{ data.id }} .sppb-gallery li {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: {{data.item_gap.sm}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-gallery {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: -{{data.item_gap.sm}}px;
                    <# } #>
                }
            }
            @media (max-width: 767px) {
                #sppb-addon-{{ data.id }} .sppb-gallery img {
                    <# if(_.isObject(data.width)){ #>
                        width: {{data.width.xs}}px;
                    <# } #>
                    <# if(_.isObject(data.height)){ #>
                        height: {{data.height.xs}}px;
                    <# } #>
                }
                
                #sppb-addon-{{ data.id }} .sppb-gallery li {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: {{data.item_gap.xs}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-gallery {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: -{{data.item_gap.xs}}px;
                    <# } #>
                }
            }
        </style>
		<div class="sppb-addon sppb-addon-gallery {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{ data.heading_selector }}><# } #>
			<div class="sppb-addon-content">
				<ul class="sppb-gallery clearfix gallery-item-{{data.item_alignment}}">
				<# _.each(data.sp_gallery_item, function (value, key) { #>
					<# if(value.thumb) { #>
						<li>
						<# if(value.full && value.full.indexOf("http://") == -1 && value.full.indexOf("https://") == -1){ #>
							<a href=\'{{ pagebuilder_base + value.full }}\' class="sppb-gallery-btn">
						<# } else if(value.full){ #>
							<a href=\'{{ value.full }}\' class="sppb-gallery-btn">
						<# } #>
							<# if(value.thumb && value.thumb.indexOf("http://") == -1 && value.thumb.indexOf("https://") == -1){ #>
								<img class="sppb-img-responsive" src=\'{{ pagebuilder_base + value.thumb }}\' alt="{{ value.title }}">
							<# } else if(value.thumb){ #>
								<img class="sppb-img-responsive" src=\'{{ value.thumb }}\' alt="{{ value.title }}">
							<# } #>
						<# if(value.full){ #>
							</a>
						<# } #>
						</li>
					<# } #>
				<# }); #>
				</ul>
			</div>
		</div>
		';

		return $output;
	}

}
