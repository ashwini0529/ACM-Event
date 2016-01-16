#include<stdio.h>
#include<math.h>
int main()

{
	int rev,i=0;
	long int num,dec=0;
	printf("Enter binary: ");
	scanf("%d",&num);
	while(num!=0)
	{
		rev=num%10;
		if(rev==1)
		{
		dec=dec+pow(2,i);
		}
		else dec=dec+0;
		i++;
		num=num/10;
	
	}
	printf("The decimal number equivalent to the given binary is : %d",dec);
	getch();
}
