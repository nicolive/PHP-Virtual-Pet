<?php /* Smarty version 2.6.22, created on 2009-09-25 14:53:08
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'index.tpl', 38, false),)), $this); ?>

<img src=/bigfatpig/img/stufe-<?php echo $this->_tpl_vars['STEP']; ?>
.png />
</td>
<td style="width: 170px;"> </td>
<td valign=top style="padding-top: 40px; padding-left: 20px;">

<img src=/bigfatpig/img/logpig_k.png />
<?php if ($this->_tpl_vars['ACTIONDONE']): ?>
	<div style="background-color: #f4f4f4;">
	
	<?php if ($this->_tpl_vars['ACTIONDONE'] == 'showered'): ?>
		You showered <i><?php echo $this->_tpl_vars['PETINFO']['net_pame']; ?>
</i>. <i><?php echo $this->_tpl_vars['PETINFO']['net_pame']; ?>
</i> is now <?php echo $this->_tpl_vars['ACTIONPOINTS']; ?>
 points cleaner than before.
	<?php endif; ?>
	<?php if ($this->_tpl_vars['ACTIONDONE'] == 'eaten'): ?>
		You gave <i><?php echo $this->_tpl_vars['PETINFO']['net_pame']; ?>
</i> some carrots and water. <i><?php echo $this->_tpl_vars['PETINFO']['net_pame']; ?>
</i> is now <?php echo $this->_tpl_vars['ACTIONPOINTS']; ?>
 points more full than before.
	<?php endif; ?>
	<?php if ($this->_tpl_vars['ACTIONDONE'] == 'doc'): ?>
		<i><?php echo $this->_tpl_vars['PETINFO']['net_pame']; ?>
</i> wasn´t amused to see the doctor. But since the doc gave him the perfect be happy go sleeping pills, everything is fine.
	<?php endif; ?>
	<?php if ($this->_tpl_vars['ACTIONDONE'] == 'played'): ?>
		<?php if ($this->_tpl_vars['ACTIONPOINTS'] == 1): ?>
			<i><?php echo $this->_tpl_vars['PETINFO']['net_pame']; ?>
</i> won against you! You damn loser! That makes <i><?php echo $this->_tpl_vars['PETINFO']['net_pame']; ?>
</i> happy!
		<?php else: ?>
			Yeah, you showed <i><?php echo $this->_tpl_vars['PETINFO']['net_pame']; ?>
</i> what it means to be a winner! You´re the greatest! But that makes <i><?php echo $this->_tpl_vars['PETINFO']['net_pame']; ?>
</i> not happier than before.
		
		<?php endif; ?>
	<?php endif; ?>	
	</div>
<?php endif; ?>

<br /><br /><b><?php echo $this->_tpl_vars['PETINFO']['pet_name']; ?>
</b> | 
<?php echo $this->_tpl_vars['AGE']['nice_days']; ?>
 day<?php if ($this->_tpl_vars['AGE']['nice_days'] != 1): ?>s<?php endif; ?>, 
<?php echo $this->_tpl_vars['AGE']['nice_hours']; ?>
 hour<?php if ($this->_tpl_vars['AGE']['nice_hours'] != 1): ?>s<?php endif; ?>, 
<?php echo $this->_tpl_vars['AGE']['nice_minutes']; ?>
 minute<?php if ($this->_tpl_vars['AGE']['nice_minutes'] != 1): ?>s<?php endif; ?> old
<br/>

<table style="width: 220px; text-align:center; margin-left: 50px;" bordeR=0 cellspacing=3>
<tr><td>full:<br/><img src=/bigfatpig/img/p.gif height=10 width=<?php echo $this->_tpl_vars['PETINFO']['fullness']; ?>
><img src=/bigfatpig/img/l.gif height=10 width="<?php echo smarty_function_math(array('equation' => "100-x",'x' => $this->_tpl_vars['PETINFO']['fullness']), $this);?>
">
</td><td>clean:<br/><img src=/bigfatpig/img/p.gif height=10 width=<?php echo $this->_tpl_vars['PETINFO']['cleanliness']; ?>
><img src=/bigfatpig/img/l.gif height=10 width="<?php echo smarty_function_math(array('equation' => "100-x",'x' => $this->_tpl_vars['PETINFO']['cleanliness']), $this);?>
">
</td></tr><tr><td>happy:<br/><img src=/bigfatpig/img/p.gif height=10 width=<?php echo $this->_tpl_vars['PETINFO']['mood']; ?>
><img src=/bigfatpig/img/l.gif height=10 width="<?php echo smarty_function_math(array('equation' => "100-x",'x' => $this->_tpl_vars['PETINFO']['mood']), $this);?>
">
</td><td>healthy:<br/><img src=/bigfatpig/img/p.gif height=10 width=<?php echo $this->_tpl_vars['PETINFO']['health']; ?>
><img src=/bigfatpig/img/l.gif height=10 width="<?php echo smarty_function_math(array('equation' => "100-x",'x' => $this->_tpl_vars['PETINFO']['health']), $this);?>
">
</td></tr></table>

<br /><h4>
<a href=./shower>shower</a> | 
<a href=./feed>feed</a> <br />
<a href=./doc>visit the doc</a> | 
play: <a href=./play-0>heads</a> or <a href=./play-1>tails</a><br /><a href=./>refresh</a></h4>


<p><br /><a href=/bigfatpig/?invite=1>invite friends</a><p>
<p><br /><a href=/bigfatpig/restart>restart</a>