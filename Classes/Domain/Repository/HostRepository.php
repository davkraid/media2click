<?php
namespace Amazing\Media2click\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Repository;

class HostRepository extends Repository
{

    /**
     * @param string $includedHosts list of host uids
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findHostsForToggle($includedHosts = '')
    {
        $query = $this->createQuery();
        $includedHostsArray = GeneralUtility::intExplode(',', $includedHosts, true);
        if (count($includedHostsArray)) {
            $query->matching(
                $query->logicalAnd(
                    $query->equals('allowPermanent',1),
                    $query->in('uid', $includedHostsArray)
                )
            );
        } else {
            $query->matching(
                $query->equals('allowPermanent', 1)
            );
        }
        return $query->execute();
    }
}
