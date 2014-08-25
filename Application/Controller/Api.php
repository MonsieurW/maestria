<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Api extends Kit
    {
        public function classAction()
        {
            $classe = new \Application\Model\Classe();
            $api    = array();

            foreach ($classe->all() as $value) {
                $api[] = $value['value'];
            }

            echo '["Amsterdam","London","Paris","Washington","New York","Los Angeles","Sydney","Melbourne","Canberra","Beijing","New Delhi","Kathmandu","Cairo","Cape Town","Kinshasa"]';

        }

        public function domainAction()
        {
            
            $classe = new \Application\Model\Domain();
            $api    = array();

            foreach ($classe as $value) {
                $api[] = $value['value'];
            }

            echo json_encode($api);     
        }

        public function classeActionAsync($classe = null)
        {
            $eleve = new \Application\Model\UserClass();
            $eleve = $eleve->getUsers($classe);

            echo json_encode($eleve);
        }

        public function classeallActionAsync($classe = null)
        {
            $eleve = new \Application\Model\Classe();
            

            echo json_encode($eleve->All());
        }

        public function controlActionAsync($user, $eval)
        {
            $evaluation = new \Application\Model\Evaluation();
            $evaluation = $evaluation->get($eval);
            $question   = new \Application\Model\Questions($eval);
            $question   = $question->get();
            
            $this->data->question = $question;
            $this->greut->render('hoa://Application/View/Evaluate/Control.tpl.php');
        }

        public function domainActionAsync()
        {
            $domaine = new \Application\Model\Domain();

            echo json_encode($domaine->all());
        }

        public function levelActionAsync()
        {
          $lvl = array();

          for($i = 1; $i <= 9; $i++)
            $lvl[] = array('value' => $i, 'text' => $i);


          echo json_encode($lvl);
        }  
        
        public function typeActionAsync()
        {
          $type = array(
            array('value' => 0, 'text' => 'Connaissance'),
            array('value' => 1, 'text' => 'Compétence')
          );

          echo json_encode($type);
        }

        public function domaineActionAsync() 
        {

          $type    = array();
          $domaine = new \Application\Model\Domain();

          foreach ($domaine->all() as $value) {
            $type[] = array('value' => $value['idDomain'], 'text' => $value['domainValue']);
          }

          echo json_encode($type);
        }

        public function themeActionAsync() 
        {

          $type    = array();
          $domaine = new \Application\Model\Theme();

          foreach ($domaine->all() as $value) {
            $type[] = array('value' => $value['idTheme'], 'text' => $value['themeValue']);
          }

          echo json_encode($type);
        }

        public function capActionAsync()
        {
            $this->capAction();
        }

        public function capAction()
        {

           echo '[
  {
    "year": "1961",
    "value": "West Side Story",
    "tokens": [
      "West",
      "Side",
      "Story"
    ]
  },
  {
    "year": "1962",
    "value": "Lawrence of Arabia",
    "tokens": [
      "Lawrence",
      "of",
      "Arabia"
    ]
  },
  {
    "year": "1963",
    "value": "Tom Jones",
    "tokens": [
      "Tom",
      "Jones"
    ]
  },
  {
    "year": "1964",
    "value": "My Fair Lady",
    "tokens": [
      "My",
      "Fair",
      "Lady"
    ]
  },
  {
    "year": "1965",
    "value": "The Sound of Music",
    "tokens": [
      "The",
      "Sound",
      "of",
      "Music"
    ]
  },
  {
    "year": "1966",
    "value": "A Man for All Seasons",
    "tokens": [
      "A",
      "Man",
      "for",
      "All",
      "Seasons"
    ]
  },
  {
    "year": "1967",
    "value": "In the Heat of the Night",
    "tokens": [
      "In",
      "the",
      "Heat",
      "of",
      "the",
      "Night"
    ]
  },
  {
    "year": "1968",
    "value": "Oliver!",
    "tokens": [
      "Oliver!"
    ]
  },
  {
    "year": "1969",
    "value": "Midnight Cowboy",
    "tokens": [
      "Midnight",
      "Cowboy"
    ]
  },
  {
    "year": "1970",
    "value": "Patton",
    "tokens": [
      "Patton"
    ]
  },
  {
    "year": "1971",
    "value": "The French Connection",
    "tokens": [
      "The",
      "French",
      "Connection"
    ]
  },
  {
    "year": "1972",
    "value": "The Godfather",
    "tokens": [
      "The",
      "Godfather"
    ]
  },
  {
    "year": "1973",
    "value": "The Sting",
    "tokens": [
      "The",
      "Sting"
    ]
  },
  {
    "year": "1974",
    "value": "The Godfather Part II",
    "tokens": [
      "The",
      "Godfather",
      "Part",
      "II"
    ]
  },
  {
    "year": "1975",
    "value": "One Flew over the Cuckoo\'s Nest",
    "tokens": [
      "One",
      "Flew",
      "over",
      "the",
      "Cuckoo\'s",
      "Nest"
    ]
  },
  {
    "year": "1976",
    "value": "Rocky",
    "tokens": [
      "Rocky"
    ]
  },
  {
    "year": "1977",
    "value": "Annie Hall",
    "tokens": [
      "Annie",
      "Hall"
    ]
  },
  {
    "year": "1978",
    "value": "The Deer Hunter",
    "tokens": [
      "The",
      "Deer",
      "Hunter"
    ]
  },
  {
    "year": "1979",
    "value": "Kramer vs. Kramer",
    "tokens": [
      "Kramer",
      "vs.",
      "Kramer"
    ]
  },
  {
    "year": "1980",
    "value": "Ordinary People",
    "tokens": [
      "Ordinary",
      "People"
    ]
  },
  {
    "year": "1981",
    "value": "Chariots of Fire",
    "tokens": [
      "Chariots",
      "of",
      "Fire"
    ]
  },
  {
    "year": "1982",
    "value": "Gandhi",
    "tokens": [
      "Gandhi"
    ]
  },
  {
    "year": "1983",
    "value": "Terms of Endearment",
    "tokens": [
      "Terms",
      "of",
      "Endearment"
    ]
  },
  {
    "year": "1984",
    "value": "Amadeus",
    "tokens": [
      "Amadeus"
    ]
  },
  {
    "year": "1985",
    "value": "Out of Africa",
    "tokens": [
      "Out",
      "of",
      "Africa"
    ]
  },
  {
    "year": "1986",
    "value": "Platoon",
    "tokens": [
      "Platoon"
    ]
  },
  {
    "year": "1987",
    "value": "The Last Emperor",
    "tokens": [
      "The",
      "Last",
      "Emperor"
    ]
  },
  {
    "year": "1988",
    "value": "Rain Man",
    "tokens": [
      "Rain",
      "Man"
    ]
  },
  {
    "year": "1989",
    "value": "Driving Miss Daisy",
    "tokens": [
      "Driving",
      "Miss",
      "Daisy"
    ]
  },
  {
    "year": "1990",
    "value": "Dances With Wolves",
    "tokens": [
      "Dances",
      "With",
      "Wolves"
    ]
  },
  {
    "year": "1991",
    "value": "The Silence of the Lambs",
    "tokens": [
      "The",
      "Silence",
      "of",
      "the",
      "Lambs"
    ]
  },
  {
    "year": "1992",
    "value": "Unforgiven",
    "tokens": [
      "Unforgiven"
    ]
  },
  {
    "year": "1993",
    "value": "Schindlerâ€™s List",
    "tokens": [
      "Schindlerâ€™s",
      "List"
    ]
  },
  {
    "year": "1994",
    "value": "Forrest Gump",
    "tokens": [
      "Forrest",
      "Gump"
    ]
  },
  {
    "year": "1995",
    "value": "Braveheart",
    "tokens": [
      "Braveheart"
    ]
  },
  {
    "year": "1996",
    "value": "The English Patient",
    "tokens": [
      "The",
      "English",
      "Patient"
    ]
  },
  {
    "year": "1997",
    "value": "Titanic",
    "tokens": [
      "Titanic"
    ]
  },
  {
    "year": "1998",
    "value": "Shakespeare in Love",
    "tokens": [
      "Shakespeare",
      "in",
      "Love"
    ]
  },
  {
    "year": "1999",
    "value": "American Beauty",
    "tokens": [
      "American",
      "Beauty"
    ]
  },
  {
    "year": "2000",
    "value": "Gladiator",
    "tokens": [
      "Gladiator"
    ]
  },
  {
    "year": "2001",
    "value": "A Beautiful Mind",
    "tokens": [
      "A",
      "Beautiful",
      "Mind"
    ]
  },
  {
    "year": "2002",
    "value": "Chicago",
    "tokens": [
      "Chicago"
    ]
  },
  {
    "year": "2003",
    "value": "The Lord of the Rings: The Return of the King",
    "tokens": [
      "The",
      "Lord",
      "of",
      "the",
      "Rings:",
      "The",
      "Return",
      "of",
      "the",
      "King"
    ]
  },
  {
    "year": "2004",
    "value": "Million Dollar Baby",
    "tokens": [
      "Million",
      "Dollar",
      "Baby"
    ]
  },
  {
    "year": "2005",
    "value": "Crash",
    "tokens": [
      "Crash"
    ]
  },
  {
    "year": "2006",
    "value": "The Departed",
    "tokens": [
      "The",
      "Departed"
    ]
  },
  {
    "year": "2007",
    "value": "No Country for Old Men",
    "tokens": [
      "No",
      "Country",
      "for",
      "Old",
      "Men"
    ]
  },
  {
    "year": "2008",
    "value": "Slumdog Millionaire",
    "tokens": [
      "Slumdog",
      "Millionaire"
    ]
  },
  {
    "year": "2009",
    "value": "The Hurt Locker",
    "tokens": [
      "The",
      "Hurt",
      "Locker"
    ]
  },
  {
    "year": "2010",
    "value": "The King\'s Speech",
    "tokens": [
      "The",
      "King\'s",
      "Speech"
    ]
  },
  {
    "year": "2011",
    "value": "The Artist",
    "tokens": [
      "The",
      "Artist"
    ]
  },
  {
    "year": "2012",
    "value": "Argo",
    "tokens": [
      "Argo"
    ]
  }
]';
        }
        
    }
}
