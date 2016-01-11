<!DOCTYPE html>
<html>
    <!Simon Su, A00852284, Set 4A, ACIT 4850 Lab 1>
    <head>
        <title>Tic-Tac-Toe</title>
    </head>
    <body>
        Welcome to Simon, the evil Tic-Tac-Toe Game!
        <br /><br />
        
        <?php
        //check if board parameter was passed already
        if (!isset($_GET['board'])) {
            echo "There is no board. The game will restart.";
            echo "<br />";
            $squares = "---------";
        } else
            $squares = $_GET['board'];
        
        //game logic for winners
        $game = new Game($squares);
        if ($game->winner('x')) {
            echo 'You win. Lucky guesses!';
        } else if ($game->winner('o')) {
            echo 'I win. Muahahahaha';
        } else {
            $game->pick_move();
            echo 'No winner yet, but you are losing.';
        }
        
        //calls the display method to visually show board
        $game->display();
        
        //link to restart the game 
        echo "<br />";
        echo "<a href='?'>Reset</a>";
        
        class Game {
            //board position property
            var $position;
            
            //constructor to take a position parameter
            function __construct($squares) {
                $this->position = str_split($squares);
            }
            
            //winning conditions method
            function winner($token) {
                $won = false;
                if (($this->position[0] == $token) &&
                        ($this->position[1] == $token) &&
                        ($this->position[2] == $token)) {
                    $won = true;
                } else if (($this->position[3] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[5] == $token)) {
                    $won = true;
                } else if (($this->position[6] == $token) &&
                        ($this->position[7] == $token) &&
                        ($this->position[8] == $token)) {
                    $won = true;
                } else if (($this->position[0] == $token) &&
                        ($this->position[3] == $token) &&
                        ($this->position[6] == $token)) {
                    $won = true;
                } else if (($this->position[1] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[7] == $token)) {
                    $won = true;
                } else if (($this->position[2] == $token) &&
                        ($this->position[5] == $token) &&
                        ($this->position[8] == $token)) {
                    $won = true;
                } else if (($this->position[0] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[8] == $token)) {
                    $won = true;
                } else if (($this->position[2] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[6] == $token)) {
                    $won = true;
                }
                return $won;
            }
            
            //visuals of the tic tac toe game
            function display() {
                echo '<table cols="3" style="font-size:large; font-weight:bold">';
                echo '<tr>'; 
                for ($pos = 0; $pos < 9; $pos++) { 
                    echo $this->show_cell($pos); 
                    if ($pos % 3 == 2) {
                        echo '</tr><tr>';
                    }                   
                }
                echo '</tr>';
                echo '</table>';
            }
            
            //displays the token positions of each player
            function show_cell($which) {
                $token = $this->position[$which];
                if ($token <> '-') {
                    return '<td>' . $token . '</td>';
                }
                $this->newposition = $this->position;
                $this->newposition[$which] = 'o';
                $move = implode($this->newposition);
                $link = '?board=' .$move;
                return '<td><a href=' . $link . '>-</a></td>';
            }
            
            //method to generate random move for the opponent
            function pick_move() {
                $fill = false;
                do {
                    //picks a random "-" spot and will fill it with "x" to represent opponent's move
                    $next = rand(0, 8);
                    if ($this->position[$next] == '-') {
                        $this->position[$next] = 'x';
                        $fill = true;
                    }
                    //keep filling until winning condition is found
                } while (!$fill);
            }
        }
        ?>
    </body>
</html>
