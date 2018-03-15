<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<SCRIPT LANGUAGE="JavaScript">
// Load the Google Transliterate API
google.load("elements", "1", {
      packages: "transliteration"
      });

      function onLoad() {
        var options = {
            sourceLanguage:
                google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage:
                [google.elements.transliteration.LanguageCode.GUJARATI],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };

        // Create an instance on TransliterationControl with the required
        // options.
        var control =
            new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textbox with id
        // 'transliterateTextarea'.
        control.makeTransliteratable(['word']);
      }
      google.setOnLoadCallback(onLoad);

// END of Google Transliteration API Code

      
</SCRIPT>

