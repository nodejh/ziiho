<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$channel = _g ( 'module' )->trigger ( 'content', 'channel' );

switch (_get ( 'op' )) {
	case 'write' :
		$channelSub = array (
				'parentid' => 0 
		);
		if (_g ( 'validate' )->hasget ( 'channelid' )) {
			$channelid = _get ( 'channelid' );
			if (! _g ( 'validate' )->pnum ( $channelid )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$channelSub = $channel->find ( 'channelid', $channelid );
			if (! is_array ( $channelSub )) {
				smsg ( lang ( 'content:100000' ) );
				return null;
			}
		}
		if (_g ( 'validate' )->hasget ( 'parentid' )) {
			if (! _g ( 'validate' )->pnum ( _get ( 'parentid' ) )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$channelSub ['parentid'] = _get ( 'parentid' );
		}
		$gobackUrl = _g ( 'cp' )->uri ( 'mod/content/ac/channel' . (_g ( 'validate' )->pnum ( $channelSub ['parentid'] ) ? ('/parentid/' . $channelSub ['parentid']) : '') );
		_g ( 'cp' )->set_template ( 'content', 'channel_write' );
		break;
	case 'write_save' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$channelid = _post ( 'channelid' );
		$parentid = _post ( 'parentid' );
		
		$listorder = _post ( 'listorder' );
		$cname = _post ( 'cname' );
		$dir = _post ( 'dir' );
		
		$status = _g('value')->sb( _post ( 'status' ) );
		$isnav = _g('value')->sb( _post ( 'isnav' ) );
		
		$target = _post ( 'target' );
		
		$seo_title = _post ( 'seo_title' );
		$seo_keywords = _post ( 'seo_keywords' );
		$seo_description = _post ( 'seo_description' );
		
		if (! _g ( 'validate' )->num ( $channelid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		if (! _g ( 'validate' )->num ( $parentid )) {
			smsg ( lang ( '110015' ) );
			return null;
		}
		
		if (strlen ( $cname ) < 1) {
			smsg ( lang ( 'content:100001' ) );
			return null;
		}
		
		$channel->write_save ( $channelid, $parentid, $listorder, $cname, $dir, $status, $isnav, $target, $seo_title, $seo_keywords, $seo_description );
		break;
	case 'update' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$channelid = _post ( 'channelid' );
		if (! my_is_array ( $channelid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$channel->update ( $channelid, _post ( 'listorder' ), _post ( 'cname' ), _post ( 'status' ) );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$channelid = _post ( 'id' );
		if (! _g ( 'validate' )->pnum ( $channelid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$channel->delete ( $channelid );
		break;
	default :
		$writeUrlStr = 'mod/content/ac/channel/op/write';
		
		_g ( 'cp' )->set_template ( 'content', 'channel' );
		break;
}
?>