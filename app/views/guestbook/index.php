<!-- views/guestbook/index.php -->
<h1>Pepperscum Guestbook 📖</h1>

<form action="index.php?page=guestbook&action=store" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="4" cols="40" required></textarea><br><br>

    <button type="submit">Sign Guestbook</button>
</form>

<hr>

<?php if (!empty($entries)): ?>
    <?php foreach ($entries as $entry): ?>
        <pre>
+--------------------------------------------------+
| <?= htmlspecialchars($entry['name']) ?> wrote: 
| <?= htmlspecialchars($entry['message']) ?>
| [<?= $entry['created_at'] ?>]
+--------------------------------------------------+
        </pre>
    <?php endforeach; ?>
<?php else: ?>
    <p>No entries yet. Be the first to sign!</p>
<?php endif; ?>