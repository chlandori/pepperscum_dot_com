<pre>
+--------------------------------------------------+
|   ████   █████  ████   ██████   ██████   █████   |
|   ██ ██  ██     ██ ██  ██   ██  ██       ██  ██  |
|   ██  ██ ████   ██  ██ ██████   ██   ██  █████   |
|   ██   █ ██     ██   █ ██   ██  ██   ██  ██  ██  |
|   ██     █████  ██     ██████   ██████   ██   ██ |
+--------------------------------------------------+
|              MODERATOR CONTROL PANEL             |
+--------------------------------------------------+
</pre>

<p>Total Guestbook Entries: <strong><?= $entriesCount ?></strong></p>
<p>Total Home Hits: <strong><?= $homeHitsCount ?></strong></p>
<p>Total Music Hits: <strong><?= $musicHitsCount ?></strong></p>
<p>Total Guestbook Hits: <strong><?= $guestbookHitsCount ?></strong></p>
<p>Total Privacy Hits: <strong><?= $privacyHitsCount ?></strong></p>
<ul>
    <li><a href="index.php?page=guestbook">View Guestbook</a></li>
    <li><a href="index.php?page=admin&action=logout">Logout</a></li>
</ul>
<p><em>Last updated: <?= date('Y-m-d H:i:s') ?></em></p>
