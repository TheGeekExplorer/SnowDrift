CREATE DEFINER=`root`@`localhost` PROCEDURE `find_avg_and_var_in_threehour_for_siteid_and_date_range`(IN inSiteID INT(11), IN inDatetime1 DATETIME, IN inDatetime2 DATETIME)
BEGIN

SELECT
	threehour.siteid,
    YEAR(threehour.datetime) as year,
    MONTH(threehour.datetime) as month,
    DAY(threehour.datetime) as day,
	ROUND(AVG(threehour.t), 1) as avgt,
    ROUND(AVG(threehour.f), 1) as avgf,
    ROUND(AVG(threehour.s), 1) as avgs,
    ROUND(AVG(threehour.g), 1) as avgg,
    MIN(threehour.t) as mint,
    MIN(threehour.f) as minf,
    MIN(threehour.s) as mins,
    MIN(threehour.g) as ming,
    MAX(threehour.t) as maxt,
    MAX(threehour.f) as maxf,
    MAX(threehour.s) as maxs,
    MAX(threehour.g) as maxg,
    ROUND(VARIANCE(threehour.t), 1) as vart,
    ROUND(VARIANCE(threehour.f), 1) as varf,
    ROUND(VARIANCE(threehour.s), 1) as vars,
    ROUND(VARIANCE(threehour.g), 1) as varg

FROM
	weather.threehour as threehour

FORCE INDEX
	(idx_siteid, idx_datetime)

WHERE
	threehour.siteid = inSiteID AND
    threehour.datetime >= inDatetime1 AND
    threehour.datetime <= inDatetime2

GROUP BY
	threehour.siteid,
    YEAR(threehour.datetime),
    MONTH(threehour.datetime),
    DAY(threehour.datetime),
    threehour.updated

ORDER BY
	threehour.updated DESC,
    YEAR(threehour.datetime) ASC,
    MONTH(threehour.datetime) ASC,
    DAY(threehour.datetime) ASC

LIMIT
	0, 5
;

END