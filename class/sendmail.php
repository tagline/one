<?php
	class sendmail
	{
		// Declaração das variáveis
		var $emailheader = "";
		var $textheader = "";
		var $textboundary = "";
		var $emailboundary = "";
		var $betreff = "";
		var $empfaenger = "";
		var $attachment = array();
		
		function sendmail()
		{
			$this->textboundary = uniqid(time());
			$this->emailboundary = uniqid(time());
		}
		
		// formata o email dentro do setor de informacoes
		function from($name,$email)	
		{
			$this->emailheader .= "From: $name <$email>\n";
			$this->emailheader .= "MIME-Version: 1.0\n";
		}
		// email em cópia oculta
		function bcc($bcc)
		{
      $this->emailheader .= "Bcc: ".$bcc."\n";
    }
    // email em cópia
		function cc($cc)
		{
      $this->emailheader .= "Cc: ".$cc."\n";
    }
		
		// endereco de destino
		function to($to)
		{
			$this->empfaenger = $to;
		}      		
		
		// titulo
		function subject($subject)
		{
			$this->betreff = $subject;
		}
		
		// texto
		function text($text)
		{
			$this->textheader .= "Content-Type: multipart/alternative; boundary=\"$this->textboundary\"\n\n";
			$this->textheader .= "--$this->textboundary\n";
			$this->textheader .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\n";
			$this->textheader .= "Content-Transfer-Enconding: quoted-printable\n\n";
			$this->textheader .= strip_tags($text)."\n\n";
			$this->textheader .= "--$this->textboundary\n";
			$this->textheader .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n";
			$this->textheader .= "Content-Transfer-Enconding: quoted-printable\n\n";
			$this->textheader .= "<html><body>$text</body></html>\n\n";
			$this->textheader .= "--$this->textboundary--\n\n";
		}
		
		// atachments
		function attachment($datei,$nome)
		{
			// Überprüfen ob File Existiert
			if(is_file($datei))		
			{
				// Header für Attachment erzeugen
				$attachment_header = "--".$this->emailboundary."\n" ;
				$attachment_header .= "Content-Type: application/octet-stream;\n name=\"$nome\"\n";
				$attachment_header .= "Content-Transfer-Encoding: base64\n";
				$attachment_header .= "Content-Disposition: attachment;\n filename=\"$nome\"\n\n";

				// Daten der Datei einlesen, in das BASE64 Format formatieren und auf max 72 Zeichen pro Zeile
				// aufteilen
				$file['inhalt'] = fread(fopen($datei,"rb"),filesize($datei));
				$file['inhalt'] = base64_encode($file['inhalt']);
				$file['inhalt'] = chunk_split($file['inhalt'],72);
				
				// Attachment mit Header in der Klassenvariable speichern
				$this->attachment[] = $attachment_header.$file['inhalt']."\n";
			}
			else
			{
				echo "Die Datei $datei existiert nicht...\n";
			}
		}
		
		// Funktion zum erstellen des Kompletten Headers der Email	
		// Senden der Email
		function send()	
		{
			$header = $this->emailheader;
			
			// Überprüfen ob Attachments angehängt wurden			
			if(count($this->attachment)>0)
			{
				$header .= 	"Content-Type: multipart/mixed; boundary=\"$this->emailboundary\"\n\n";
				$header .= "--$this->emailboundary\n";
				$header .= $this->textheader;
				
				for($i=0;$i<count($this->attachment);$i++)
				{
					$header .= $this->attachment[$i];
				}
				
				$header .= "--$this->emailboundary--";
			}
			else
			{
				$header .= $this->textheader;
			}
			
			// envia o mail
			mail("$this->empfaenger",$this->betreff,"",$header);
		}
		
		function htmlMail($corpo) {
			
			$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    					 <html xmlns="http://www.w3.org/1999/xhtml">
    					 <head>
    					 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    					
    					 </body>
    					 </html>';
			
			return $body;
			
		}
	}

?>
