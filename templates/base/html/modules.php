<?php
// Protection contre les appels directs.
defined("_JEXEC") or die("Restricted access");
function modChrome_joomspirit($module, &$params, &$attribs) {
   	// init vars
	$showtitle = $module->showtitle;
	$content   = $module->content;
	$suffix    = '';
	$badge		='';
 
	// force module type
	if ($module->position == 'logo')  $suffix = 'logo';
	if ($module->position == 'banner')  $suffix = 'logo';
	if ($module->position == 'left')  $suffix = 'normal';
	if ($module->position == 'right')  $suffix = 'normal';
	if ($module->position == 'search')  $suffix = 'normal';
	if ($module->position == 'address')  $suffix = 'normal';
	if ($module->position == 'top')  $suffix = 'normal';
	if ($module->position == 'bottom')  $suffix = 'normal';
	if ($module->position == 'bottom_menu')  $suffix = 'no-title';
	if ($module->position == 'translate')  $suffix = 'no-title';
	if ($module->position == 'block-menu')  $suffix = 'menu';
    if ($module->position == 'home-menu')  $suffix = 'menu';
    if ($module->position == 'catalog-menu')  $suffix = 'menu';
	if ($module->position == 'footer-sp1')  $suffix = 'footer';
	if ($module->position == 'footer-sp2')  $suffix = 'footer-menu';
	if ($module->position == 'footer-sp3')  $suffix = 'footer-menu';
	if ($module->position == 'footer-sp4')  $suffix = 'footer';
	if ($module->position == 'sidebar')  $suffix = 'noblock';
	if ($module->position == 'breadcrumb')  $suffix = 'noblock';
	if ($module->position == 'bread-crumb')  $suffix = 'noblock';
	if ($module->position == 'teasers')  $suffix = 'noblock';
	if ($module->position == 'user7')  $suffix = 'normal';
	if ($module->position == 'user8')  $suffix = 'normal';
	if ($module->position == 'user9')  $suffix = 'normal';
	if ($module->position == 'ga')  $suffix = 'google_code';

	
	// set module skeleton using the suffix
	switch ($suffix) {
		case 'logo':
			$skeleton = 'logo';
			break;
		case 'normal':
			$skeleton = 'normal';
			break;
        case 'noblock':
            $skeleton = 'noblock';
            break;
        case 'footer':
        $skeleton = 'footer';
        break;
        case 'footer-menu':
            $skeleton = 'footer-menu';
            break;
        case 'menu':
			$skeleton = 'menu';
			break;
		case 'google_code':
			$skeleton = 'google_code';
			break;				
		case 'no-title':
			$skeleton = 'no-title';
			break;	
		default:
			$skeleton = 'not defined';
	}
	// Modules
	switch ($skeleton) {
		case 'logo':
			/*
			 * logo module
			 */
			?>
			
				<div class="<?php echo $suffix; ?> <?php echo $params->get('moduleclass_sfx'); ?>">
					
					<?php echo $content; ?>
			
				</div>

			
			<?php 
			break;
		case 'normal':
			/*
			 * normal
			 */
			?>
			<div class="moduletable <?php echo $params->get('moduleclass_sfx'); ?>" >
				<div>
					<?php if ($showtitle) : ?>
					<div class="module-title">
						<h3 class="module"><span class="<?php echo $params->get('header_class'); ?>" ><?php echo $module->title ; ?></span></h3>
					</div>
					<?php endif; ?>
			
					<div class="content-module">
						<?php echo $content; ?>
					</div>
				</div>
				
				<div class="icon-module"></div>
			</div>
			<?php 
			break;
        case 'noblock':
            /*
             * normal
             */
            ?>
               <?php echo $content; ?>
            <?php
            break;
        case 'footer':
            /*
             * footer
             */
            ?>
                        <?php echo $content; ?>
            <?php
            break;
        case 'footer-menu':
            /*
             * footer-menu
             */
            ?>
                <span class="title"><?php echo $module->title ; ?></span>
                <?php echo $content; ?>
            <?php
            break;
		case 'menu':
			?>
				<?php echo $content; ?>
			<?php 
			break;		
			
		case 'no-title':
			/*
			 * no title modules
			 */
			?>
			<div class="moduletable <?php echo $params->get('moduleclass_sfx'); ?>" >
			
				<div class="content-module">
					<?php echo $content; ?>
				</div>

			</div>
			<?php 
			break;			

		case 'google_code':
			/*
			 * for google analytics tracking code
			 */
			?>
					<?php echo $content; ?>

			<?php 
			break;
			
		default:
			/*
			 * not defined
			 */
			?>
			<div class="module <?php echo $suffix; ?>">
				<?php if ($showtitle) : ?>
				<h3 class="module"><span class="<?php echo $params->get('header_class'); ?>" ><?php echo $module->title ; ?></span></h3>
				<?php endif; ?>
				<?php echo $content; ?>
			</div>
			<?php 
			break;
	}
}
?>