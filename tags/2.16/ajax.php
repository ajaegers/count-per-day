<?php
if ( $_GET['f'] == 'count' )
{
	if (!session_id()) session_start();
	require_once($_SESSION['cpd_wp'].'wp-load.php');

	$cpd_funcs = CountPerDay_Widget::getWidgetFuncs();
	$page = intval($_GET['page']);
	if ( is_numeric($page) )
	{
		$count_per_day->count( '', $page );
		foreach ( $cpd_funcs as $f )
		{
			if ( ($f == 'show' && $page) || $f != 'show' )
			{
				echo $f.'===';
				if ( $f == 'getUserPerDay' )
					eval('echo $count_per_day->getUserPerDay('.$count_per_day->options['dashboard_last_days'].');');
				else if ( $f == 'show' )
					eval('echo $count_per_day->show("", "", false, false, '.$page.');');
				else
					eval('echo $count_per_day->'.$f.'();');
				echo '|';
			}
		}
	}
}
