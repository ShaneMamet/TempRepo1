<?php

//http://css-tricks.com/serious-form-security/
}

function StripContent($s){
		// Restores the added slashes (ie.: " I\'m John " for security in output, and escapes them in htmlentities(ie.:  &quot; etc.)
		// It preserves any <html> tags in that they are encoded aswell (like &lt;html&gt;)
		// As an extra security, if people would try to inject tags that would become tags after stripping away bad characters,
		// we do still strip tags but only after htmlentities, so any genuine code examples will stay
		// Use: For input fields that may contain html, like a textarea
		return replaceSingleQuotes( strip_tags( htmlentities ( trim( stripslashes($s) ) , ENT_NOQUOTES, "UTF-8") )  );
}

function	replaceSingleQuotes($data) {
  return str_replace( "'", "''", $data );   
}

?>