<?php

	// Copyright (C) 2014-2016 Jacob Barkdull, Stéphane Mourey
	//
	//	I, Jacob Barkdull, hereby release this work into the public domain.
	//	This applies worldwide. If this is not legally possible, I grant any
	//	entity the right to use this work for any purpose, without any
	//	conditions, unless such conditions are required by law.
	//
	// French translation by Stéphane Mourey
	//
	//	I, Stéphane Mourey, hereby release this work into the public domain.
	//	This applies worldwide. If this is not legally possible, I grant any
	//	entity the right to use this work for any purpose, without any
	//	conditions, unless such conditions are required by law.


	// Display source code
	if (isset($_GET['source']) and basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
		header('Content-type: text/plain; charset=UTF-8');
		exit(file_get_contents(basename(__FILE__)));
	}

	// Text for forms, buttons, links, and tooltips in multiple languages
	$locale = array(
		'en' => array(
			'comment_form'	=> 'Type Comment Here (other fields optional)',
			'reply_form'	=> 'Type Reply Here (other fields optional)',
			'post_button'	=> 'Post Comment',
			'del_note'	=> 'This comment has been deleted.',
			'cmt_deleted'	=> 'Comment Deleted!',
			'options'	=> 'Options',
			'cancel'	=> 'Cancel',
			'reply_to_cmt'	=> 'Reply To Comment',
			'edit_your_cmt'	=> 'Edit Your Comment',
			'nickname_tip'	=> 'Nickname or Twitter @username',
			'nickname'	=> 'Nickname or @user',
			'password_tip'	=> 'Password (only needed for editing/deleting comment later)',
			'password'	=> 'Password',
			'email'		=> 'E-mail Address',
			'website'	=> 'Website',
			'logged_in'	=> 'You have been successfully logged in!',
			'cmt_needed'	=> 'You failed to enter a proper comment. Use the form below.',
			'reply_needed'	=> 'You failed to enter a proper reply. Use the form below.',
			'post_fail'	=> 'Comment failed to post! You lack sufficient permission.',
			'cmt_tip'	=> 'Accepted HTML: &lt;b&gt;, &lt;u&gt;, &lt;i&gt;, &lt;s&gt;, &lt;pre&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;, &lt;blockquote&gt;, &lt;code&gt; escapes HTML, URLs automagically become links, and [img]URL here[/img] will display an external image.',
			'post_reply'	=> 'Post Reply',
			'delete'	=> 'Delete',
			'subscribe_tip'	=> 'Subscribe to E-mail Notifications',
			'subscribe'	=> 'Subscribe',
			'edit_cmt'	=> 'Edit Comment',
			'save_edit'	=> 'Save Edit',
			'no_email_warn'	=> 'You will not receive notification of replies to your comment without supplying an e-mail.',
			'delete_cmt'	=> 'Are you sure you want to delete this comment?',
			'post_cmt'	=> 'Post a Comment',
			'popular_cmts'	=> 'Most Popular',
			'showing_cmts'	=> 'Showing',
			'sort'		=> 'Sort',
			'sort_ascend'	=> 'In Order',
			'sort_descend'	=> 'In Reverse Order',
			'sort_byname'	=> 'By Commenter',
			'sort_bydate'	=> 'By Date (newest first)',
			'sort_bylikes'	=> 'By Likes',
			'thread'	=> 'Top of Thread',
			'thread_tip'	=> 'Jump to top of thread',
			'like_cmt'	=> '\'Like\' This Comment',
			'liked_cmt'	=> 'You \'Liked\' This Comment',
			'op_cmt_note'	=> 'You will not be notified via e-mail',
			'subbed_note'	=> 'will be notified via e-mail',
			'unsubbed_note' => 'is not subscribed to e-mail notifications'
		),

		'es' => array(
			'comment_form'     => 'Escriba su comentario aqu&iacute; (otros campos opcionales)',
			'reply_form'       => 'Escriba su respuesta aqu&iacute; (otros campos opcionales)',
			'post_button'      => 'Publicar comentario',
			'del_note' => 'Este comentario ha sido eliminado.',
			'cmt_deleted'      => '¡Comentario eliminado!',
			'options'  => 'Opciones',
			'cancel'   => 'Cancelar',
			'reply_to_cmt'     => 'Responder al comentario',
			'edit_your_cmt'    => 'Editar comentario',
			'nickname_tip'     => 'Apodo o nombre de Twitter @username',
			'nickname' => 'Apodo o @user',
			'password_tip'     => 'Contrase&ntilde;a (necesara s&oacute;lo para editar/borrar comentario)',
			'password'  => 'Contrase&ntilde;a',
			'email'    => 'E-mail',
			'website'  => 'Sitio Web',
			'logged_in'        => '¡Conectado con &eacute;xito!',
			'cmt_needed'       => 'No ha ingresado un comentario v&aacute;lido. Utilice el siguiente formulario.',
			'reply_needed'     => 'No ha ingresado una respuesta v&aacute;lida. Utilice el siguiente formulario.',
			'post_fail'        => '¡Fallo al enviar comentario! Permisos insuficientes.',
			'cmt_tip'  => 'HTML aceptado: &lt;b&gt;, &lt;u&gt;, &lt;i&gt;, &lt;s&gt;, &lt;pre&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;, &lt;blockquote&gt;, &lt;code&gt; escapa el c&oacute;digo HTML, las URLs se convierten autom&aacute;gicamente en enlaces, y [img]URL[/img] muestra una imagen externa.',
			'post_reply'       => 'Enviar respuesta',
			'delete'   => 'Borrar',
			'subscribe_tip'    => 'Suscribirse a las notificaciones por correo electr&oacute;nico',
			'subscribe'        => 'Suscribirse',
			'edit_cmt' => 'Redactar comentario',
			'save_edit'        => 'Guardar edici&oacute;n',
			'no_email_warn'    => 'Es necesario suministrar una direcci&oacute;n de correo electr&oacute;nico para recibir las notificaci&oacute;nes de las respuestas a su comentario.',
			'delete_cmt'       => '¿Seguro que desea eliminar este comentario?',
			'post_cmt' => 'Publicar un comentario',
			'popular_cmts'     => 'Los m&aacute;s populares',
			'showing_cmts'     => 'Mostrando',
			'sort'     => 'Ordenar',
			'sort_ascend'      => 'Ascendente',
			'sort_descend'     => 'Inverso',
			'sort_byname'      => 'Por usuario',
			'sort_bydate'      => 'Por fecha (m&aqacute;s recientes primero)',
			'sort_bylikes'     => 'Por likes',
			'thread'   => 'Inicio del tema',
			'thread_tip'       => 'Ir al inicio del tema',
			'like_cmt' => 'le gusta este comentario',
			'liked_cmt'        => 'Te ha gustado este comentario',
			'op_cmt_note'      => 'No se notificar&aacute; por correo electr&oacute;nico',
			'subbed_note'      => 'ser&aacute; notificado v%iacute;a e-mail',
			'unsubbed_note' => 'no est&aacute; suscrito a las notificaciones por correo electr&oacute;nico'
		),

		'jp' => array(
			'comment_form'	=> 'ここにコメントを入力し（その他のフィールドはオプショナル）',
			'reply_form'	=> 'ここに返信を入力し（その他のフィールドはオプショナル）',
			'post_button'	=> 'コメントポスト',
			'del_note'	=> 'このコメントは削除されました。',
			'cmt_deleted'	=> 'コメント削除た',
			'options'	=> 'のオプション',
			'cancel'	=> '取り消す',
			'reply_to_cmt'	=> 'コメントへ返信',
			'edit_your_cmt'	=> 'あなたのコメントを編集',
			'nickname_tip'	=> 'ニックネームTwitterまたは @username',
			'nickname'	=> 'ニックネームまたは @user',
			'password_tip'	=> 'パスワード（後でコメントを編集/削除するためにのみ）',
			'password'	=> 'パスワード',
			'email'		=> 'メールアドレス',
			'website'	=> 'ウェブサイト',
			'logged_in'	=> 'あなたは、正常にログインされています！',
			'cmt_needed'	=> 'あなたが適切なコメントを入力ていませんでした。下記のフォームを使用。',
			'reply_needed'	=> 'あなたが適切なを入力応答ていませんでした。下記のフォームを使用。',
			'post_fail'	=> 'コメントをするには失敗しました！あなたは十分な権限を欠いている。',
			'cmt_tip'	=> 'HTML容認：&lt;b&gt;、&lt;u&gt;、&lt;i&gt;、&lt;s&gt;、&lt;pre&gt;、&lt;ul&gt;、&lt;ol&gt;、&lt;li&gt;、&lt;blockquote&gt;、&lt;code&gt;はHTMLをエスケープ、URLは自動的にリンクになり、とここで[img]URLここ[/img]外部画像を表示します。',
			'post_reply'	=> 'ポスト返信',
			'delete'	=> '削除',
			'subscribe_tip'	=> '電子メール通知を購読',
			'subscribe'	=> '購読する',
			'edit_cmt'	=> 'コメントを編集',
			'save_edit'	=> '保存編集',
			'no_email_warn'	=> 'あなたは、電子メールをずにあなたのコメントへの返信の通知を受け取ることができません。',
			'delete_cmt'	=> 'あなたはこのコメントを削除してもよろしいですか？',
			'post_cmt'	=> 'コメントの投稿',
			'popular_cmts'	=> '人気',
			'showing_cmts'	=> '表示',
			'sort'		=> 'ソート',
			'sort_ascend'	=> '順番に',
			'sort_descend'	=> '逆の順番で',
			'sort_byname'	=> '評者によって',
			'sort_bydate'	=> '日によって（最初最新）',
			'sort_bylikes'	=> 'によって Likes',
			'thread'	=> 'ねじ山の頂',
			'thread_tip'	=> 'スレッドの先頭にジャンプ',
			'like_cmt'	=> '「Like」このコメントを',
			'liked_cmt'	=> '君「Liked」このコメントを',
			'op_cmt_note'	=> 'あなたが電子メールを介して通知されません',
			'subbed_note'	=> '電子メールを介して通知され',
			'unsubbed_note' => 'は、電子メール通知にサブスクライブされていない'
		),

		'fr' => array(
			'comment_form'	=> 'Tapez votre commentaire ici (les autres champs sont optionnels)',
			'reply_form'	=> 'Tapez votre réponse ici (les autres champs sont optionnels)',
			'post_button'	=> 'Envoyez votre commentaire',
			'del_note'	=> 'Ce commentaire a été effacé.',
			'cmt_deleted'	=> 'Commentaire effacé!',
			'options'	=> 'Options',
			'cancel'	=> 'Annuler',
			'reply_to_cmt'	=> 'Répondre au commentaire',
			'edit_your_cmt'	=> 'Editer votre commentaire',
			'nickname_tip'	=> 'Surnom ou @nom_d_utilisateur Twitter',
			'nickname'	=> 'Surnom ou @nom_d_utilisateur',
			'password_tip'	=> 'Mot de passe (requis seulement pour modifier/supprimer votre commentaire plus tard)',
			'password'	=> 'Mot de passe',
			'email'		=> 'Adresse email',
			'website'	=> 'Site web',
			'logged_in'	=> 'Vous vous êtes identifié avec succès !',
			'cmt_needed'	=> 'Vous avez échoué à entrer un commentaire acceptable. Utilisez le formulaire ci-dessous.',
			'reply_needed'	=> 'Vous avez échoué à entrer une réponse acceptable. Utilisez le formulaire ci-dessous.',
			'post_fail'	=> 'Echec de la soumission du commentaire ! Vous n&apos;avez pas les permissions suffisantes.',
			'cmt_tip'	=> 'HTML accepté :  &lt;b&gt;, &lt;u&gt;, &lt;i&gt;, &lt;s&gt;, &lt;pre&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;, &lt;blockquote&gt;, &lt;code&gt; échappe le HTML, les URLs sont transformées en liens automatiquement, et [img]adresse de l&apos;image ici[/img] va afficher une image externe.',
			'post_reply'	=> 'Envoyer la réponse',
			'delete'	=> 'Effacer',
			'subscribe_tip'	=> 'S&apos;abonner aux notifications par mail',
			'subscribe'	=> 'S&apos;abonner',
			'edit_cmt'	=> 'Editer le commentaire',
			'save_edit'	=> 'Enregistrer la modification',
			'no_email_warn'	=> 'Vous ne recevrez pas de notification de réponse à votre commentaire si vous ne fournissez pas d&apos;adresse email',
			'delete_cmt'	=> 'Êtes-vous sûr de vouloir effacer ce commentaire ?',
			'post_cmt'	=> 'Envoyer un commentaire',
			'popular_cmts'	=> 'Les plus populaire',
			'showing_cmts'	=> 'Affiché',
			'sort'		=> 'Trié',
			'sort_ascend'	=> 'Dans l&apos;ordre',
			'sort_descend'	=> 'Dans l&apos;ordre inverse',
			'sort_byname'	=> 'Par commentateur',
			'sort_bydate'	=> 'Par date (les plurs récents en premier)',
			'sort_bylikes'	=> 'Par popularité',
			'thread'	=> 'Début du fil',
			'thread_tip'	=> 'Sauter au début du fil',
			'like_cmt'	=> '&apos;Aimer&apos; ce commentaire',
			'liked_cmt'	=> 'Vous avez &apos;aimé&apos; ce commentaire',
			'op_cmt_note'	=> 'Vous ne serez pas notifié par email',
			'subbed_note'	=> 'sera notifié par email',
			'unsubbed_note'	=> 'ne s&apos;est pas abandonner aux notifications par email'
		)
	);

	// Set locale to language in settings
	$text = $locale[$language];

?>
