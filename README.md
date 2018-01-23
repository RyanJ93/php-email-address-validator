# E-mail validator (PHP edition)

A very simple library that allows you to validate an e-mail address, check if it exists through online connection and check if the provider is a disposable one or not.

# E-mail validation

String validation:

`PHPEmailAddressValidator::validateString($email);`

Complete validation:

`PHPEmailAddressValidator::validate($email);`

The complete validation will check address syntax first, after that will check for provider existence through DNS resolution and then will check if the given e-mail address exists.

# E-mail provider check

Before using these methods you should set up dictionaries as following:

`PHPEmailAddressValidator::setWhiteListDatabasePath('whitelist.txt');`
`PHPEmailAddressValidator::setBlackListDatabasePath('blacklist.txt');`
`PHPEmailAddressValidator::setDisposableProvidersDatabasePath('disposable.txt');`

Check if the e-mail provider is accepted:

`PHPEmailAddressValidator::isTrustedProvider($email, $disposableAllowed, $strict);`

With accepted is meant that the provider is found within the given white list, if strict mode is not enabled, will be also checked if the provider is found within the black list, in this case will be returned "false".
If the provider is checked using strict mode will be returned "true" only if it is found within the given white list.
Both white list and black list must be plain text files and providers must be separated by a break line (\n).

Check if the e-mail provider is disposable:

`PHPEmailAddressValidator::isDisposableProvider($disposable);`

This method will check if the provider is included in the given list containing the disposable providers, a list with most common disposable providers is shipped with this library (kindly offered by [@michenriksen](https://gist.github.com/michenriksen/8710649)).
Disposable providers list must be plain text files and providers must be separated by a break line (\n).

Are you looking for the Node.js version? Give a look [here](https://github.com/RyanJ93/email-address-validator).