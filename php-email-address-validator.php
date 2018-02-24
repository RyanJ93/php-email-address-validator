<?php
namespace PHPEmailAddressValidator{
	class PHPEmailAddressValidator{
		/**
		* @const int DEFAULT_MX_TIMEOUT The default timeout (in seconds) used during connection with the e-mail provider to test.
		*/
		const DEFAULT_MX_TIMEOUT = 90;
		
		/**
		* @var string $whiteListDatabasePath A string containing the path to the file that contains a list of accepted email providers separated by a breakline (\n).
		*/
		protected static $whiteListDatabasePath = NULL;
		
		/**
		* @var string $whiteListDatabase A string containing the content of the of the providers' white list, if it is going to be cached for next uses.
		*/
		protected static $whiteListDatabase = NULL;
		
		/**
		* @var bool $whiteListCache If set to "true", the content of the of the providers' white list will be cached for next uses, otherwise not.
		*/
		protected static $whiteListCache = false;
		
		/**
		* @var string $whiteListEncoding A string representing the encoding of the providers' white list file.
		*/
		protected static $whiteListEncoding = NULL;
		
		/**
		* @var string $blackListDatabasePath A string containing the path to the file that contains a list of banned email providers separated by a breakline (\n).
		*/
		protected static $blackListDatabasePath = NULL;
		
		/**
		* @var string $blackListDatabase A string containing the content of the of the providers' black list, if it is going to be cached for next uses.
		*/
		protected static $blackListDatabase = NULL;
		
		/**
		* @var bool $blackListCache If set to "true", the content of the of the providers' black list will be cached for next uses, otherwise not.
		*/
		protected static $blackListCache = false;
		
		/**
		* @var string $blackListEncoding A string representing the encoding of the providers' black list file.
		*/
		protected static $blackListEncoding = NULL;
		
		/**
		* @var string $disposableProvidersDatabasePath A string containing the path to the file that contains a list of disposable email providers separated by a breakline (\n).
		*/
		protected static $disposableProvidersDatabasePath = NULL;
		
		/**
		* @var string $disposableProvidersDatabase A string containing the content of the of the disposable email providers' list, if it is going to be cached for next uses.
		*/
		protected static $disposableProvidersDatabase = NULL;
		
		/**
		* @var bool $disposableProvidersCache If set to "true", the content of the of the disposable email providers' list will be cached for next uses, otherwise not.
		*/
		protected static $disposableProvidersCache = false;
		
		/**
		* @var string $disposableProvidersEncoding A string representing the encoding of the disposable email providers' list file.
		*/
		protected static $disposableProvidersEncoding = NULL;
		
		/**
		* @var int $MXTimeout An integer number greater than zero representing the timeout (in seconds) used during connection with the e-mail provider to test.
		*/
		protected static $MXTimeout = 90;
		
		/**
		* Sets the path to the file that contains the list of accepted email providers.
		*
		* @param string $path A string containing the path to the file.
		*/
		public static function setWhiteListDatabasePath(string $path = NULL){
			if ( $path === '' ){
				$path = NULL;
			}
			if ( self::$whiteListDatabasePath !== $path ){
				self::$whiteListDatabase = self::$whiteListCache === false ? NULL : '';
				self::$whiteListDatabasePath = $path;
			}
		}
		
		/**
		* Returns the path to the file that contains the list of accepted email providers.
		*
		* @return string A string containing the path to the file.
		*/
		public static function getWhiteListDatabasePath(): string{
			$dictionary = self::$whiteListDatabasePath;
			return $dictionary === NULL ? '' : $dictionary;
		}
		
		/**
		* Sets if the list of accepted email providers shall be cached or not.
		*
		* @param bool $value If set to "true", the content of the file will be cached for next uses, otherwise not.
		*/
		public static function setWhiteListCache(bool $value = false){
			if ( $value !== true ){
				self::$whiteListCache = false;
				self::$whiteListDatabase = NULL;
				return;
			}
			self::$whiteListCache = true;
		}
		
		/**
		* Returns if the list of accepted email providers shall be cached or not.
		*
		* @return bool If the file cache is enabled will be returned "true", otherwise "false".
		*/
		public static function getWhiteListCache(): bool{
			return self::$whiteListCache === true ? true : false;
		}
		
		/**
		* Cleares the content of the white list providers' cache.
		*/
		public static function invalidateWhiteListCache(){
			self::$whiteListDatabase = NULL;
		}
		
		/**
		* Loads the content of the list of accepted email providers that has been set.
		*
		* @return bool If some data is loaded from the file will be returned "true", otherwise "false".
		*
		* @throws Exception If an error occurs while reading file contents.
		*/
		public static function loadWhiteListCache(): bool{
			if ( self::$whiteListCache === false || self::$whiteListDatabasePath === NULL ){
				return false;
			}
			$data = @file_get_contents(self::$whiteListDatabasePath);
			if ( $data === false ){
				throw new \Exception('Unable to load the dictionary.');
			}
			self::$whiteListDatabase = $data;
			return true;
		}
		
		/**
		* Sets the encoding of the providers' white list file.
		*
		* @param string $encoding A string representing the file encoding, if set to NULL, the internal encoding will be used instead.
		*/
		public function setWhiteListEncoding(string $encoding = NULL){
			self::$whiteListEncoding = $encoding === '' ? NULL : $encoding;
		}
		
		/**
		* Returns the encoding of the providers' white list file.
		*
		* @return string A string representing the file encoding.
		*/
		public function getWhiteListEncoding(): string{
			$encoding = self::$whiteListEncoding;
			return $encoding === NULL ? '' : $encoding;
		}
		
		/**
		* Sets the path to the file that contains the list of banned email providers.
		*
		* @param string $path A string containing the path to the file. 
		*/
		public static function setBlackListDatabasePath(string $path = NULL){
			if ( $path === '' ){
				$path = NULL;
			}
			if ( self::$blackListDatabasePath !== $path ){
				self::$blackListDatabase = self::$blackListCache === false ? NULL : '';
				self::$blackListDatabasePath = $path;
				return;
			}
		}
		
		/**
		* Returns the path to the file that contains the list of banned email providers.
		*
		* @return string A string containing the path to the file.
		*/
		public static function getBlackListDatabasePath(): string{
			$dictionary = self::$blackListDatabasePath;
			return $dictionary === NULL ? '' : $dictionary;
		}
		
		/**
		* Sets if the list of banned email providers shall be cached or not.
		*
		* @param bool $value If set to "true", the content of the file will be cached for next uses, otherwise not.
		*/
		public static function setBlackListCache(bool $value = false){
			if ( $value !== true ){
				self::$blackListCache = false;
				self::$blackListDatabase = NULL;
				return;
			}
			self::$blackListCache = true;
		}
		
		/**
		* Returns if the list of banned email providers shall be cached or not.
		*
		* @return bool If the file cache is enabled will be returned "true", otherwise "false".
		*/
		public static function getBlackListCache(): bool{
			return self::$blackListCache === true ? true : false;
		}
		
		/**
		* Cleares the content of the black list providers' cache.
		*/
		public static function invalidateBlackListCache(){
			self::$blackListDatabase = NULL;
		}
		
		/**
		* Loads the content of the list of banned email providers that has been set.
		*
		* @return bool If some data is loaded from the file will be returned "true", otherwise "false".
		*
		* @throws Exception If an error occurs while reading file contents.
		*/
		public static function loadBlackListCache(): bool{
			if ( self::$blackListCache === false || self::$blackListDatabasePath === NULL ){
				return false;
			}
			$data = @file_get_contents(self::$blackListDatabasePath);
			if ( $data === false ){
				throw new \Exception('Unable to load the dictionary.');
			}
			self::$blackListDatabase = $data;
			return true;
		}
		
		/**
		* Sets the encoding of the providers' black list file.
		*
		* @param string $encoding A string representing the file encoding, if set to NULL, the internal encoding will be used instead.
		*/
		public function setBlackListEncoding(string $encoding = NULL){
			self::$blackListEncoding = $encoding === '' ? NULL : $encoding;
		}
		
		/**
		* Returns the encoding of the providers' black list file.
		*
		* @return string A string representing the file encoding.
		*/
		public function getBlackListEncoding(): string{
			$encoding = self::$blackListEncoding;
			return $encoding === NULL ? '' : $encoding;
		}
		
		/**
		* Sets the path to the file that contains the list of disposable email providers.
		*
		* @param string $path A string containing the path to the file.
		*/
		public static function setDisposableProvidersDatabasePath(string $path = NULL){
			if ( $path === '' ){
				$path = NULL;
			}
			if ( self::$disposableProvidersDatabasePath !== $path ){
				self::$disposableProvidersDatabase = self::$disposableProvidersCache === false ? NULL : '';
				self::$disposableProvidersDatabasePath = $path;
			}
		}
		
		/**
		* Returns the path to the file that contains the list of disposable email providers.
		*
		* @return string A string containing the path to the file.
		*/
		public static function getDisposableProvidersDatabasePath(): string{
			$dictionary = self::$disposableProvidersDatabasePath;
			return $dictionary === NULL ? '' : $dictionary;
		}
		
		/**
		* Sets if the list of disposable email providers shall be cached or not.
		*
		* @param bool $value If set to "true", the content of the file will be cached for next uses, otherwise not.
		*/
		public static function setDisposableProvidersCache(bool $value = false){
			if ( $value !== true ){
				self::$disposableProvidersCache = false;
				self::$disposableProvidersDatabase = NULL;
				return;
			}
			self::$disposableProvidersCache = true;
		}
		
		/**
		* Returns if the list of disposable email providers shall be cached or not.
		*
		* @return bool If the file cache is enabled will be returned "true", otherwise "false".
		*/
		public static function getDisposableProvidersCache(): bool{
			return self::$disposableProvidersCache === true ? true : false;
		}
		
		/**
		* Cleares the content of the disposable list providers' cache.
		*/
		public static function invalidateDisposableProvidersCache(){
			self::$disposableProvidersDatabase = NULL;
		}
		
		/**
		* Loads the content of the list of disposable email providers that has been set.
		*
		* @return bool If some data is loaded from the file will be returned "true", otherwise "false".
		*
		* @throws Exception If an error occurs while reading file contents.
		*/
		public static function loadDisposableProvidersCache(): bool{
			if ( self::$disposableProvidersCache === false || self::$disposableProvidersDatabasePath === NULL ){
				return false;
			}
			$data = @file_get_contents(self::$disposableProvidersDatabasePath);
			if ( $data === false ){
				throw new \Exception('Unable to load the dictionary.');
			}
			self::$disposableProvidersDatabase = $data;
			return true;
		}
		
		/**
		* Sets the encoding of the disposable email providers' list file.
		*
		* @param string $encoding A string representing the file encoding, if set to NULL, the internal encoding will be used instead.
		*/
		public function setDisposableProvidersEncoding(string $encoding = NULL){
			self::$disposableProvidersEncoding = $encoding === '' ? NULL : $encoding;
		}
		
		/**
		* Returns the encoding of the disposable email providers' list file.
		*
		* @return string A string representing the file encoding.
		*/
		public function getDisposableProvidersEncoding(): string{
			$encoding = self::$disposableProvidersEncoding;
			return $encoding === NULL ? '' : $encoding;
		}
		
		/**
		* Sets the timeout used during connection with the e-mail provider to test.
		*
		* @param int $timeout An integer number greater than zero representing the timeout (in seconds), if set to NULL the default timeout will be used instead.
		*/
		public static function setMXTimeout(int $timeout = NULL){
			self::$MXTimeout = $timeout === NULL || $timeout <= 0 ? self::DEFAULT_MX_TIMEOUT : $timeout;
		}
		
		/**
		* Returns the timeout used during connection with the e-mail provider to test.
		*
		* @return int An integer number greater than zero representing the timeout (in seconds).
		*/
		public static function getMXTimeout(): int{
			return self::$MXTimeout;
		}
		
		/**
		* Checks if a given e-mail address is valid or not.
		*
		* @param string $email A string containg the e-mail address.
		*
		* @return bool If the given e-mail address is valid will be returned "true", otherwise "false".
		*/
		public static function validateString(string $email): bool{
			return $email === '' || $email === NULL || !preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email) ? false : true;
		}
		
		/**
		* Checks if a given e-mail address is valid and if it exists.
		*
		* @param string $email A string containing the e-mail address.
		*/
		public static function validate(string $email): bool{
			if ( $email === NULL || $email === '' || self::validateString($email) === false ){
				return false;
			}
			$provider = mb_strtolower(mb_split('@', $email)[1]);
			$result = dns_get_record($provider, \DNS_MX);
			if ( $result === false ){
				return false;
			}
			usort($result, function($a, $b){
				if ( $a['pri'] > $b['pri'] ){
					return 1;
				}
				return $a['pri'] < $b['pri'] ? -1 : 0;
			});
			$email = str_replace(array('<', '>', "\r", "\n"), '', $email);
			foreach ( $result as $key => $value ){
				if ( isset($value['target']) === false || $value['target'] === '' || is_string($value['target']) === false ){
					continue;
				}
				$buffer = fsockopen($value['target'], 25, $errorCode, $errorStr, self::$MXTimeout);
				if ( $buffer === false || mb_substr(fgets($buffer), 0, 3, 'UTF-8') !== '220' ){
					continue;
				}
				fputs($buffer, 'HELO ' . $value['target'] . "\r\n");
                fgets($buffer);
                fputs($buffer, "MAIL FROM: <no-reply@mail.com>\r\n"); 
                $from = fgets($buffer);
                fputs($buffer, 'RCPT TO: <' . $email . ">\r\n"); 
                $to = fgets($buffer);
                fputs($buffer, 'QUIT'); 
                fclose($buffer);
                if ( $from !== false && mb_substr($from, 0, 3, 'UTF-8') === '250' && $to !== false && mb_substr($to, 0, 3, 'UTF-8') === '250' ){
	                return true;
                }
			}
			return false;
		}
		
		/**
		* Checks if a given email address or a provider is trusted (if is in a given white list and not in a given black list).
		*
		* @param string $string A string containing the e-mail address or the e-mail provider.
		* @param bool $disposableAllowed If set to "false" will be checked if the provider is a disposable one, otherwise not.
		* @param bool $strict If set to "true" means that the given provider must be within the withe list set, otherwise it will not be accepted.
		*
		* @return bool If the provider is trusted will be returned "true", otherwise "false".
		*
		* @throws InvalidArgumentException If the provided string is not a valid e-mail address nor a valid domain name.
		* @throws Exception If an error occurs while reading data from a file.
		* @throws Exception If an error occurs while checking if the given address is disposable or the given provider is a disposable e-mail provider.
		*/
		public static function isTrustedProvider(string $string, bool $disposableAllowed = true, bool $strict = false): bool{
			if ( $string === NULL || $string === '' ){
				throw new \InvalidArgumentException('Invalid e-mail address.');
			}
			if ( mb_strpos($string, '@') !== false ){
				if ( self::validateString($string) === false ){
					throw new \InvalidArgumentException('Invalid e-mail address.');
				}
				$string = mb_split('@', $string)[1];
			}
			$string = mb_strtolower($string);
			$path = self::$whiteListDatabasePath;
			if ( $path !== NULL ){
				$encoding = self::$whiteListEncoding;
				if ( $encoding === NULL ){
					$encoding = mb_internal_encoding();
				}
				if ( self::$whiteListCache === true && self::$whiteListDatabase !== NULL ){
					if ( mb_strpos(self::$whiteListDatabase, "\n", NULL, $encoding) === false && self::$whiteListDatabase === $string ){
						return true;
					}
					if ( mb_strpos(self::$whiteListDatabase, $string . "\n", NULL, $encoding) !== false || mb_strpos(self::$whiteListDatabase, "\n" . $string, NULL, $encoding) !== false ){
						return true;
					}
				}else{
					$database = @file_get_contents(self::$whiteListDatabasePath);
					if ( $database === false ){
						throw new \Exception('Unable to read from white list database.');
					}
					if ( $database !== '' ){
						if ( self::$whiteListCache === true ){
							self::$whiteListDatabase = $database;
						}
						if ( mb_strpos($database, "\n", NULL, $encoding) === false && $database === $string ){
							return true;
						}
						if ( mb_strpos($database, $string . "\n", NULL, $encoding) !== false || mb_strpos($database, "\n" . $string, NULL, $encoding) !== false ){
							return true;
						}
					}
				}
			}
			if ( $strict === true ){
				return false;
			}
			$path = self::$blackListDatabasePath;
			if ( $path !== NULL ){
				$encoding = self::$blackListEncoding;
				if ( $encoding === NULL ){
					$encoding = mb_internal_encoding();
				}
				if ( self::$blackListCache === true && self::$blackListDatabase !== NULL ){
					if ( mb_strpos(self::$blackListDatabase, "\n", NULL, $encoding) === false && self::$blackListDatabase === $string ){
						return true;
					}
					if ( mb_strpos(self::$blackListDatabase, $string . "\n", NULL, $encoding) !== false || mb_strpos(self::$blackListDatabase, "\n" . $string, NULL, $encoding) !== false ){
						return true;
					}
				}else{
					$database = @file_get_contents(self::$blackListDatabasePath);
					if ( $database === false ){
						throw new \Exception('Unable to read from black list database.');
					}
					if ( $database !== '' ){
						if ( self::$blackListCache === true ){
							self::$blackListDatabase = $database;
						}
						if ( mb_strpos($database, "\n", NULL, $encoding) === false && $database === $string ){
							return true;
						}
						if ( mb_strpos($database, $string . "\n", NULL, $encoding) !== false || mb_strpos($database, "\n" . $string, NULL, $encoding) !== false ){
							return true;
						}
					}
				}
			}
			if ( $disposableAllowed === false && self::$disposableProvidersDatabasePath !== NULL ){
				try{
					if ( self::isDisposableProvider($string) === true ){
						return false;
					}
				}catch(\Exception $ex){
					throw new \Exception('Unable to check the given provider.');
				}
			}
			return true;
		}
		
		/**
		* Checks if a given e-mail or provider is a disposable one.
		*
		* @param string $string A string containing the e-mail address or the e-mail provider.
		*
		* @return bool If the provider is disposable will be returned "true", otherwise "false".
		*
		* @throws InvalidArgumentException If the provided string is not a valid e-mail address nor a valid domain name.
		* @throws Exception If no file containing the list of disposable e-mail providers has been defined.
		* @throws Exception If an error occurs while reading data from a file.
		*/
		public static function isDisposableProvider(string $string): bool{
			if ( $string === NULL || $string === '' ){
				throw new \InvalidArgumentException('Invalid e-mail address.');
			}
			if ( mb_strpos($string, '@') !== false ){
				if ( self::validateString($string) === false ){
					throw new \InvalidArgumentException('Invalid e-mail address.');
				}
				$string = mb_split('@', $string)[1];
			}
			$string = mb_strtolower($string);
			$path = self::$disposableProvidersDatabasePath;
			if ( $path === NULL ){
				throw new \Exception('No database defined.');
			}
			$encoding = self::$disposableProvidersEncoding;
			if ( $encoding === NULL ){
				$encoding = mb_internal_encoding();
			}
			if ( self::$disposableProvidersCache === true && self::$disposableProvidersDatabase !== '' ){
				if ( mb_strpos(self::$disposableProvidersDatabase, "\n", NULL, $encoding) === false && self::$disposableProvidersDatabase === $string ){
					return true;
				}
				if ( mb_strpos(self::$disposableProvidersDatabase, $string . "\n", NULL, $encoding) !== false || mb_strpos(self::$disposableProvidersDatabase, "\n" . $string, NULL, $encoding) !== false ){
					return true;
				}
			}else{
				$database = @file_get_contents(self::$disposableProvidersDatabasePath);
				if ( $database === false ){
					throw new \Exception('Unable to read from the disposable providers database.');
				}
				if ( $database !== '' ){
					if ( self::$disposableProvidersCache === true ){
						self::$disposableProvidersDatabase = $database;
					}
					if ( mb_strpos($database, "\n", NULL, $encoding) === false && $database === $string ){
						return true;
					}
					if ( mb_strpos($database, $string . "\n", NULL, $encoding) !== false || mb_strpos($database, "\n" . $string, NULL, $encoding) !== false ){
						return true;
					}
				}
			}
			return false;
		}
	}
}