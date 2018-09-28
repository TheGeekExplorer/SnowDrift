CREATE DEFINER=`root`@`localhost` PROCEDURE `check_token_is_authorised`(IN inAppKey VARCHAR(45), IN inConsumerKey VARCHAR(45))
BEGIN


SELECT
	authkeys.expires

FROM
	weather.authkeys as authkeys

WHERE
	authkeys.appkey = inAppKey AND
    authkeys.consumerkey = inConsumerKey

ORDER BY
	authkeys.expires DESC

LIMIT
	0, 1
;


END