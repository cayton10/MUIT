=== MUAvailSoft ===



### Smart Search (Auto Suggestion)

#### 2.19.2021

The smart search function is broken up amongst 3 files. All files should be sufficiently documented to detail how the function actually works. 

jQuery -> MUAvailSoft/admin/js/adminjs.js
Ajax Handler -> MUAvailSoft/admin/ajax/ajax_functions.php
PHP Class -> MUAvailSoft/classes/SmartSearch_class.php

#### 2.23.2021

Added functionality so user's can `TAB` select a suggestion or use mouse clicks to select.
When the suggestion is selected, the input fields are populated with that selection and the
suggestion div is hidden. 