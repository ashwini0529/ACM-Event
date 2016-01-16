#include<stdio.h>
#include<conio.h>
#include<windows.h>
int main()
{void gotoxy(short x, short y) 
{
COORD pos = {x, y};
SetConsoleCursorPosition(GetStdHandle(STD_OUTPUT_HANDLE), pos);
}
	int i,j;
	char a[5][5];
	int c=0;
	for(i=0;i<5;i++)
	{
		for(j=0;j<5;j++)
		{
		a[i][j]=97;
		if(i+j==c)
		{
			gotoxy(i,j);
		printf("%d",a[i][j]);
		Sleep(200);c++;
		}
	}
}}
