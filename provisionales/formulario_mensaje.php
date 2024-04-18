<form id="form_mensaje" action="enviar_mensaje.php" method="post">
    <textarea name="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea>
    <input type="hidden" name="id_amigo" value="<?php echo $id_amigo; ?>">
    <input type="submit" value="Enviar">
</form>
