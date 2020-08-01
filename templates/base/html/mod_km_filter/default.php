<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::_('script', 'jui/chosen.jquery.min.js', false, true, false, false);
JHtml::_('stylesheet', 'jui/chosen.css', false, true);
?>
<div class="ksm-module-filter ksm-block <?php echo $class_sfx?>">
    <div class="open_label">Подбор по параметрам</div>
    <form action="<?php echo $form_action; ?>" method="get" data-price_min="<?php echo (int) $price_min; ?>" data-price_max="<?php echo (int) $price_max; ?>" data-price_less="<?php echo (int) $price_less; ?>" data-price_more="<?php echo (int) $price_more; ?>" data-show_filter_button="<?php echo $params->get('show_filter_button', 0); ?>">
        <span class="close_but"></span>
        <?php if ($mod_params['price']['view'] != 'none'): ?>
            <div class="section price_select ksm-module-filter-block ksm-module-filter-block-prices ksm-module-filter-block-<?php echo $mod_params['price']['view']; ?>">
                <div class="title">Цена &#8381;</div>
                <?php if ($mod_params['price']['view'] == 'slider'): ?>
                    <div class="inputs">
                        <input type="text" id="min_price" class="ksm-module-filter-block-prices-less price-range-field" name="price_less" value="<?php echo (int)$price_less?>" />
                        <input type="text" id="max_price" class="ksm-module-filter-block-prices-more price-range-field" name="price_more" value="<?php echo (int)$price_more?>" />
                    </div>
                    <div class="ksm-module-filter-block-prices-tracker" id="slider-range"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="ksm-module-filter-block-properties">
            <?php foreach($properties as $property){ ?>
                <?php if(!empty($property->values) && $property->view != 'none'){ ?>
                    <div class="section ksm-module-filter-block ksm-module-filter-block-property ksm-module-filter-block-property-<?php echo $property->property_id?> ksm-module-filter-block-<?php echo $property->display?> ksm-module-filter-block-<?php echo $property->view?>">
                        <div class="title"><?php echo $property->title; ?></div>
                        <ul class="ksm-module-filter-block-listing">
                            <?php if ($property->view != 'list'): ?>
                                <?php foreach($property->values as $value){ ?>
                                    <li class="ksm-module-filter-block-listing-item <?php echo $value->selected?' active':''; ?>" data-id="<?php echo $value->id; ?>">
                                        <label>
                                            <?php if ($property->view == 'checkbox'){ ?>
                                                <input value="<?php echo $value->id; ?>" <?php if ($value->selected) echo 'checked'; ?> name="properties[]" onchange="KMChangeFilter(this);" type="checkbox" />
                                                <span class="checkbox_imitation"></span><?php echo $value->title; ?>
                                            <?php }elseif ($property->view == 'radio'){ ?>
                                                <input value="<?php echo $value->id; ?>" <?php if ($value->selected) echo 'checked'; ?> name="properties[<?php echo $property->property_id; ?>]" onchange="KMChangeFilter(this);" type="radio" />
                                                <span class="radio_imitation"></span><?php echo $value->title; ?>
                                            <?php }else{ ?>
                                                <input style="display:none;" onchange="KMChangeFilter(this);" type="checkbox" name="properties[]" value="<?php echo $value->id; ?>" <?php if ($value->selected) echo 'checked'; ?> />
                                                <span class="checkbox_imitation"></span><?php echo $value->title; ?>
                                            <?php } ?>
                                        </label>
                                    </li>
                                <?php } ?>
                            <?php else: ?>
                                <li class="ksm-module-filter-block-listing-row">
                                    <select name="properties[]" onchange="KMChangeFilter(this);">
                                        <option value=""><?php echo JText::_('MOD_KM_FILTER_CHOOSE')?></option>
                                        <?php foreach($property->values as $value){ ?>
                                            <option class="ksm-module-filter-block-listing-item <?php if ($value->selected) echo 'active'; ?>" value="<?php echo $value->id; ?>" data-id="<?php echo $value->id; ?>" <?php if ($value->selected) echo 'selected'; ?>><?php echo $value->title; ?></option>
                                        <?php } ?>
                                    </select>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
       <?php if ($params->get('show_filter_button', 0) == 1 || $params->get('show_clear_button', 0) == 1): ?>
            <div class="ksm-module-filter-block ksm-module-filter-block-buttons">
                <?php if ($params->get('show_filter_button', 0) == 1): ?>
                    <input type="button" class="ksm-module-filter-button-filter ksm-btn-success" value="<?php echo JText::_('MOD_KM_FILTER_FIND'); ?>" onclick="KMChangeFilter(this);">
                <?php endif; ?>
                <?php if ($params->get('show_filter_button', 0) == 1): ?>
                    <input type="button" class="ksm-module-filter-button-clear" value="<?php echo JText::_('MOD_KM_FILTER_CLEAR'); ?>" onclick="KMClearFilter();">
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php foreach($categories as $category){ ?>
            <input type="hidden" name="categories[]" value="<?php echo $category;?>" />
        <?php } ?>
        <input type="hidden" name="order_type" value="<?php echo $order_type;?>" />
        <input type="hidden" name="order_dir" value="<?php echo $order_dir;?>" />
    </form>
</div>
<script>
    var view='<?php echo JRequest::getVar('view',''); ?>';
    var price_min=<?php echo (int)$price_min; ?>;
    var price_max=<?php echo (int)$price_max; ?>;
    var price_less=<?php echo (int)$price_less; ?>;
    var price_more=<?php echo (int)$price_more; ?>;
    var show_filter_button=<?php echo $params->get('show_filter_button', 0); ?>;
</script>