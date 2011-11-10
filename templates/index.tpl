
<img src=/pet/img/stufe-{$STEP}.png />
</td>
<td style="width: 170px;"> </td>
<td valign=top style="padding-top: 40px; padding-left: 20px;">

<img src=/pet/img/logpig_k.png />
{if $ACTIONDONE}
	<div style="background-color: #f4f4f4;">
	
	{if $ACTIONDONE == 'showered'}
		You showered <i>{$PETINFO.net_pame}</i>. <i>{$PETINFO.net_pame}</i> is now {$ACTIONPOINTS} points cleaner than before.
	{/if}
	{if $ACTIONDONE == 'eaten'}
		You gave <i>{$PETINFO.net_pame}</i> some carrots and water. <i>{$PETINFO.net_pame}</i> is now {$ACTIONPOINTS} points more full than before.
	{/if}
	{if $ACTIONDONE == 'doc'}
		<i>{$PETINFO.net_pame}</i> wasn´t amused to see the doctor. But since the doc gave him the perfect be happy go sleeping pills, everything is fine.
	{/if}
	{if $ACTIONDONE == 'played'}
		{if $ACTIONPOINTS == 1}
			<i>{$PETINFO.net_pame}</i> won against you! You damn loser! That makes <i>{$PETINFO.net_pame}</i> happy!
		{else}
			Yeah, you showed <i>{$PETINFO.net_pame}</i> what it means to be a winner! You´re the greatest! But that makes <i>{$PETINFO.net_pame}</i> not happier than before.
		
		{/if}
	{/if}	
	</div>
{/if}

<br /><br /><b>{$PETINFO.pet_name}</b> | 
{$AGE.nice_days} day{if $AGE.nice_days != 1}s{/if}, 
{$AGE.nice_hours} hour{if $AGE.nice_hours != 1}s{/if}, 
{$AGE.nice_minutes} minute{if $AGE.nice_minutes != 1}s{/if} old
<br/>

<table style="width: 220px; text-align:center; margin-left: 50px;" bordeR=0 cellspacing=3>
<tr><td>full:<br/><img src=/pet/img/p.gif height=10 width={$PETINFO.fullness}><img src=/pet/img/l.gif height=10 width="{math equation="100-x" x=$PETINFO.fullness}">
</td><td>clean:<br/><img src=/pet/img/p.gif height=10 width={$PETINFO.cleanliness}><img src=/pet/img/l.gif height=10 width="{math equation="100-x" x=$PETINFO.cleanliness}">
</td></tr><tr><td>happy:<br/><img src=/pet/img/p.gif height=10 width={$PETINFO.mood}><img src=/pet/img/l.gif height=10 width="{math equation="100-x" x=$PETINFO.mood}">
</td><td>healthy:<br/><img src=/pet/img/p.gif height=10 width={$PETINFO.health}><img src=/pet/img/l.gif height=10 width="{math equation="100-x" x=$PETINFO.health}">
</td></tr></table>

<br /><h4>
<a href=./shower>shower</a> | 
<a href=./feed>feed</a> <br />
<a href=./doc>visit the doc</a> | 
play: <a href=./play-0>heads</a> or <a href=./play-1>tails</a><br /><a href=./>refresh</a></h4>

{*
if(md5($info[dead]) != "8e30a659c31b53017073692309ab0da1") echo "<h2>dead</h2>";
*}

<p><br /><a href=/pet/?invite=1>invite friends</a><p>
<p><br /><a href=/pet/restart>restart</a>
