<?php
namespace Application\Service;

/**
 * This service is responsible for determining which items should be in the main menu.
 * The items may be different depending on whether the user is authenticated or not.
 */
class NavManager
{
    /**
     * Auth service.
     * @var Zend\Authentication\Authentication
     */
    private $authService;
    
    /**
     * Url view helper.
     * @var Zend\View\Helper\Url
     */
    private $urlHelper;
    
    /**
     * RBAC manager.
     * @var User\Service\RbacManager
     */
    private $rbacManager;
    
    /**
     * Constructs the service.
     */
    public function __construct($authService, $urlHelper, $rbacManager) 
    {
        $this->authService = $authService;
        $this->urlHelper = $urlHelper;
        $this->rbacManager = $rbacManager;
    }
    
    /**
     * This method returns menu items depending on whether user has logged in or not.
     */
    public function getMenuItems() 
    {
        $url = $this->urlHelper;
        $items = [];
        
        $items[] = [
            'id' => 'home',
            'label' => 'Home',
            'link'  => $url('home')
        ];
        
        $items[] = [
            'id' => 'Regels',
            'label' => 'Rules',
            'link'  => $url('rules')
        ];

        $items[] = [
            'id' => 'schedule',
            'label' => 'Schema',
            'link'  => $url('game-schedule')
        ];
        
        $items[] = [
            'id' => 'results',
            'label' => 'Uitslagen',
            'link'  => $url('games-results')
        ];
        
        // Display "Login" menu item for not authorized user only. On the other hand,
        // display "Admin" and "Logout" menu items only for authorized users.
        if (!$this->authService->hasIdentity()) {
            $items[] = [
                'id' => 'login',
                'label' => 'Sign in',
                'link'  => $url('login'),
                'float' => 'right'
            ];
        } else {
            
            // Determine which items must be displayed in Admin dropdown.
            $adminDropdownItems = [];
            
            if ($this->rbacManager->isGranted(null, 'user.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'users',
                            'label' => 'Users',
                            'link' => $url('users')
                        ];
            }
            
            if ($this->rbacManager->isGranted(null, 'permission.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'permissions',
                            'label' => 'Permissions',
                            'link' => $url('permissions')
                        ];
            }
            
            if ($this->rbacManager->isGranted(null, 'role.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'roles',
                            'label' => 'Roles',
                            'link' => $url('roles')
                        ];
            }

            if (count($adminDropdownItems)!=0) {
                $items[] = [
                    'id' => 'admin',
                    'label' => 'User Manage',
                    'dropdown' => $adminDropdownItems
                ];
            }

            if ($this->rbacManager->isGranted(null, 'season.manage')) {
                $seasonDropdownItems[] = [
                    'id' => 'seasons',
                    'label' => 'Seasons',
                    'link' => $url('seasons')
                ];
            }
            if ($this->rbacManager->isGranted(null, 'competition.manage')) {
                $seasonDropdownItems[] = [
                    'id' => 'competitions',
                    'label' => 'Competitions',
                    'link' => $url('competitions')
                ];
            }
            if ($this->rbacManager->isGranted(null, 'player.manage')) {
                $seasonDropdownItems[] = [
                    'id' => 'players',
                    'label' => 'Players',
                    'link' => $url('players')
                ];
            }


            if (count($seasonDropdownItems)!=0) {
                $items[] = [
                    'id' => 'season',
                    'label' => 'Season manage',
                    'dropdown' => $seasonDropdownItems
                ];
            }


            if ($this->rbacManager->isGranted(null, 'language.manage')) {
                $translatorDropdownItems[] = [
                            'id' => 'language',
                            'label' => 'Languages',
                            'link' => $url('languages')
                        ];
            }
            
            if ($this->rbacManager->isGranted(null, 'translation.manage')) {
                $translatorDropdownItems[] = [
                            'id' => 'translation',
                            'label' => 'Translations',
                            'link' => $url('translations')
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'translation.manage')) {
                $translatorDropdownItems[] = [
                    'id' => 'translator',
                    'label' => 'Translation files',
                    'link' => $url('translators')
                ];
            }
            
            if (count($translatorDropdownItems)!=0) {
                $items[] = [
                    'id' => 'translator',
                    'label' => 'Translator manage',
                    'dropdown' => $translatorDropdownItems
                ];
            }
            
            $items[] = [
                'id' => 'logout',
                'label' => $this->authService->getIdentity(),
                'float' => 'right',
                'dropdown' => [
                    [
                        'id' => 'settings',
                        'label' => 'Settings',
                        'link' => $url('application', ['action'=>'settings'])
                    ],
                    [
                        'id' => 'logout',
                        'label' => 'Sign out',
                        'link' => $url('logout')
                    ],
                ]
            ];
        }
        
        return $items;
    }
}


