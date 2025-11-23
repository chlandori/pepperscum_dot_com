<!-- views/guestbook/index.php -->
<h1>Pepperscum Guestbook 📖</h1>

<form action="index.php?page=guestbook&action=store" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" maxlength="50" required><br><br>

    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="4" cols="40" maxlength="150" required></textarea><br><br>

    <button type="submit">Sign Guestbook</button>
</form>

<hr>
<?php if (!empty($_SESSION['is_admin'])): ?>
<pre>
+----------------------------------+
|   MODERATOR MODE ACTIVE 🔒      |
+----------------------------------+
</pre>
<a href="index.php?page=admin&action=panel">[Admin Panel]</a>
<a href="index.php?page=admin&action=logout">[Logout]</a>

<?php endif; ?>

<?php if (!empty($entries)): ?>
    <?php foreach ($entries as $entry): ?>
        <pre>
+--------------------------------------------------+
| <?= htmlspecialchars($entry['name']) ?> wrote:
| <?= htmlspecialchars($entry['message']) ?>
| [<?= $entry['created_at'] ?>]<?php if (!empty($_SESSION['is_admin'])): ?><a href="index.php?page=guestbook&action=delete&id=<?= $entry['id'] ?>"
       onclick="return confirm('Delete this entry?');">[Delete]</a><?php endif; ?>
<br>+--------------------------------------------------+
        </pre>
    <?php endforeach; ?>
<?php else: ?>
    <p>No entries yet. Be the first to sign!</p>
<?php endif; ?>