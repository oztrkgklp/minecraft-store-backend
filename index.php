<?php
	define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);
	require_once(__ROOT__."/private/config/settings.php");
?>
<!DOCTYPE html>
<html lang="tr">
	<head>
		<meta name="shopinext-verification" content="0hd13cji5ihio7k5qadva9fscid2vas7" />
	    <meta name="yandex-verification" content="8db83098c6cfdc70" />
		<?php require_once(__ROOT__."/apps/dashboard/private/layouts/head.php"); ?>
	</head>
	<body>
		<?php require_once(__ROOT__."/apps/dashboard/private/layouts/sidebar.php"); ?>
		<div class="main-content">
			<?php require_once(__ROOT__."/apps/dashboard/private/layouts/header.php"); ?>
			<main class="main" role="main">
				<?php if (preg_match('/^[A-Za-z0-9\.\-]+$/', get("route"))): ?>
					<?php $routeFile = __ROOT__."/apps/dashboard/private/content/".get("route").".php"; ?>
					<?php if (file_exists($routeFile)): ?>
						<?php include $routeFile; ?>
					<?php else: ?>
						<?php go("/404"); ?>
					<?php endif; ?>
				<?php else: ?>
					<?php go("/404"); ?>
				<?php endif; ?>
			</main>
		</div>
		<?php require_once(__ROOT__."/apps/dashboard/private/layouts/footer.php"); ?>
		<?php require_once(__ROOT__."/apps/dashboard/private/layouts/scripts.php"); ?>
	</body>
</html>
<?php ob_end_flush(); 
?>