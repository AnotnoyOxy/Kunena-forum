<?php
/**
 * Kunena Component
 * @package Kunena.Template.Crypsis
 * @subpackage User
 *
 * @copyright (C) 2008 - 2013 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();
?>
<h3>
	<?php echo $this->headerText; ?>
</h3>

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1 center">
				#
			</th>
			<th class="span3">
				<?php echo JText::_('COM_KUNENA_BAN_BANNEDFROM'); ?>
			</th>
			<th class="span2">
				<?php echo JText::_('COM_KUNENA_BAN_STARTTIME'); ?>
			</th>
			<th class="span2">
				<?php echo JText::_('COM_KUNENA_BAN_EXPIRETIME'); ?>
			</th>
			<th class="span2">
				<?php echo JText::_('COM_KUNENA_BAN_CREATEDBY'); ?>
			</th>
			<th class="span2">
				<?php echo JText::_('COM_KUNENA_BAN_MODIFIEDBY'); ?>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (!empty($this->banHistory)) :
			$i = count($this->banHistory);
			foreach ($this->banHistory as $banInfo) :
		?>
		<tr>
			<td class="center">
				<?php echo $i--; ?>
			</td>
			<td>
				<?php echo $banInfo->blocked ? JText::_('COM_KUNENA_BAN_BANLEVEL_JOOMLA') : JText::_('COM_KUNENA_BAN_BANLEVEL_KUNENA') ?>
			</td>
			<td>
				<?php if ($banInfo->created_time) echo KunenaDate::getInstance($banInfo->created_time)->toKunena('datetime'); ?>
			</td>
			<td>
				<?php echo $banInfo->isLifetime() ? JText::_('COM_KUNENA_BAN_LIFETIME') : KunenaDate::getInstance($banInfo->expiration)->toKunena('datetime'); ?>
			</td>
			<td>
				<?php echo $banInfo->getCreator()->getLink(); ?>
			</td>
			<td>
				<?php
				if ($banInfo->modified_by && $banInfo->modified_time)
					echo $banInfo->getModifier()->getLink() . ' ' . KunenaDate::getInstance($banInfo->modified_time)->toKunena('datetime');
				?>
			</td>
		</tr>
		<?php if ($banInfo->reason_public) : ?>
		<tr>
			<td></td>
			<td>
				<b><?php echo JText::_('COM_KUNENA_BAN_PUBLICREASON'); ?></b>
			</td>
			<td colspan="4">
				<?php echo KunenaHtmlParser::parseText ($banInfo->reason_public); ?>
			</td>
		</tr>
		<?php endif; ?>
		<?php if($this->me->isModerator() && $banInfo->reason_private) : ?>
		<tr>
			<td></td>
			<td>
				<b><?php echo JText::_('COM_KUNENA_BAN_PRIVATEREASON'); ?></b></td>
			<td colspan="4">
				<?php echo KunenaHtmlParser::parseText ($banInfo->reason_private); ?>
			</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->me->isModerator() && is_array($banInfo->comments)) foreach ($banInfo->comments as $comment) : ?>
		<tr>
			<td></td>
			<td>
				<b><?php echo JText::sprintf('COM_KUNENA_BAN_COMMENT_BY', KunenaFactory::getUser(intval($comment->userid))->getLink()) ?></b>
			</td>
			<td>
				<?php echo KunenaDate::getInstance($comment->time)->toKunena(); ?>
			</td>
			<td colspan="3">
				<?php echo KunenaHtmlParser::parseText ($comment->comment); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php endforeach; ?>

		<?php else : ?>

		<tr>
			<td colspan="6">
				<?php echo JText::sprintf('COM_KUNENA_BAN_USER_NOHISTORY', $this->escape($this->profile->name)); ?>
			</td>
		</tr>
		<?php endif; ?>
	</tbody>
</table>